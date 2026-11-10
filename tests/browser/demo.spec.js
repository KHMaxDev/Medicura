import { test, expect } from "@playwright/test";

test("filters, pagination, printing and institutions enforce relationships", async ({page}) => {
  await page.goto('/admin/patients');
  await expect(page.locator('tbody tr')).toHaveCount(8);
  await page.getByRole('button',{name:'Página siguiente'}).click();
  await expect(page.locator('.pagination')).toContainText('Página 2 de 3');
  await page.getByLabel('Buscar registros').fill('Lucía');
  await expect(page.locator('tbody tr')).toHaveCount(1);
  await page.getByLabel('Buscar registros').fill('');
  await page.evaluate(()=>window.dispatchEvent(new Event('beforeprint')));
  await expect(page.locator('tbody tr')).toHaveCount(18);
  await page.evaluate(()=>window.dispatchEvent(new Event('afterprint')));
  await expect(page.locator('tbody tr')).toHaveCount(8);
  await page.goto('/admin/doctors');
  await page.getByLabel('Filtrar por estado').selectOption('Pendiente');
  await expect(page.locator('tbody tr')).toHaveCount(2);
  await page.goto('/admin/institutions');
  await page.getByRole('button',{name:'Eliminar Centro Médico del Caribe'}).click();
  await expect(page.getByRole('status')).toContainText('doctores asociados');
  await page.goto('/admin/institutions/create');
  await page.getByLabel('Nombre',{exact:true}).fill('Institución de prueba');
  await page.getByLabel('Dirección',{exact:true}).fill('Calle de ejemplo 1');
  await page.getByLabel('Teléfono',{exact:true}).fill('9985550100');
  await page.getByLabel('Correo electrónico').fill('institucion@example.test');
  await page.getByRole('button',{name:'Guardar institución'}).click();
  await expect(page.locator('#main h1')).toHaveText('Institución de prueba');
  await page.getByRole('link',{name:'Volver',exact:true}).click();
  await page.getByRole('button',{name:'Eliminar Institución de prueba'}).click();
  await page.locator('#dialog-confirm').click();
  await expect(page.locator('tbody')).not.toContainText('Institución de prueba');
});

test("contact simulates submission and tablet layouts remain within viewport", async ({page}) => {
  await page.goto('/');
  await page.getByLabel('Tu nombre').fill('Persona de prueba');
  await page.getByLabel('Correo electrónico').fill('contacto@example.test');
  await page.getByLabel('Mensaje').fill('Hola');
  await page.getByRole('button',{name:'Probar envío'}).click();
  await expect(page.getByRole('status')).toContainText('No se ha enviado ningún correo');
  for (const width of [768,1024]) {
    await page.setViewportSize({width,height:1000});
    await page.goto('/admin');
    await expect(page.locator('#main h1')).toBeVisible();
    expect(await page.evaluate(()=>document.documentElement.scrollWidth<=innerWidth)).toBe(true);
  }
});
test("selector opens both panels without login and every module renders", async ({
    page,
}) => {
    const errors = [];
    page.on("pageerror", (error) => errors.push(error.message));
    await page.goto("/login");
    await expect(page.locator("input[type=password]")).toHaveCount(0);
    await page.getByRole("link", { name: "Entrar como doctor" }).click();
    await expect(
        page.getByRole("heading", { name: "Buen día, Elena." }),
    ).toBeVisible();
    await page.getByRole("link", { name: "Cambiar interfaz" }).click();
    await page.getByRole("link", { name: "Entrar como administrador" }).click();
    for (const url of [
        "/admin/doctors",
        "/admin/doctors/pending",
        "/admin/patients",
        "/admin/institutions",
        "/admin/medicines",
        "/admin/appointments",
        "/admin/reports",
        "/doctor/patients",
        "/doctor/patients/search",
        "/doctor/appointments",
        "/doctor/medicines",
        "/doctor/treatments",
    ]) {
        await page.goto(url);
        await expect(page.locator("#main h1")).toBeVisible();
        await expect(page.locator("#main")).not.toContainText(
            "Registro no encontrado",
        );
    }
    expect(errors).toEqual([]);
});
test("patient create edit reload search and delete update the same state", async ({
    page,
}) => {
    await page.goto("/admin/patients/create");
    await page.getByRole("button", { name: "Guardar paciente" }).click();
    await expect(page.locator("#form-errors")).toBeVisible();
    for (const [label, value] of [
        ["Nombre completo", "Paciente de prueba"],
        ["Correo electrónico", "prueba@example.test"],
        ["Teléfono", "9985550123"],
        ["Fecha de nacimiento", "1995-01-01"],
        ["CURP de ejemplo", "PRUEBA000000000001"],
    ])
        await page.getByLabel(label, { exact: true }).fill(value);
    await page.getByRole("button", { name: "Guardar paciente" }).click();
    await expect(page.locator("#main h1")).toHaveText("Paciente de prueba");
    const url = page.url();
    await page.reload();
    await expect(page.locator("#main h1")).toHaveText("Paciente de prueba");
    await page.getByRole("link", { name: "Editar", exact: true }).click();
    await page.getByLabel("Nombre completo").fill("Paciente actualizado");
    await page.getByRole("button", { name: "Guardar paciente" }).click();
    await expect(page.locator("#main h1")).toHaveText("Paciente actualizado");
    await page.getByRole("link", { name: "Volver", exact: true }).click();
    await page.getByLabel("Buscar registros").fill("Paciente actualizado");
    await expect(page.locator("tbody tr")).toHaveCount(1);
    await page
        .getByRole("button", { name: "Eliminar Paciente actualizado" })
        .click();
    await page.locator("#dialog-confirm").click();
    await expect(page.locator("tbody tr")).toHaveCount(0);
    await page.goto(url);
    await expect(page.locator("#main h1")).toHaveText("Registro no encontrado");
});
test("appointment collision, treatment creation and patient association work", async ({
    page,
}) => {
    await page.goto("/doctor/appointments/create");
    await page.getByLabel("Paciente", { exact: true }).selectOption("p1");
    await page.getByLabel("Hora de inicio").fill("09:15");
    await page.getByLabel("Hora de fin").fill("09:40");
    await page.getByLabel("Motivo").fill("Prueba");
    await page.getByRole("button", { name: "Guardar cita" }).click();
    await expect(page.locator("#error-start")).toContainText(
        "ya tiene una cita",
    );
    await page.getByLabel("Hora de inicio").fill("18:00");
    await page.getByLabel("Hora de fin").fill("18:30");
    await page.getByRole("button", { name: "Guardar cita" }).click();
    await expect(page.locator("#main h1")).toContainText("Cita de Lucía");
    await page.goto("/doctor/treatments/create");
    await page.getByLabel("Nombre del tratamiento").fill("Plan de prueba");
    await page.getByLabel("Paciente", { exact: true }).selectOption("p1");
    await page.getByLabel("Dosis de ejemplo").fill("Demostración");
    await page
        .getByLabel("Descripción", { exact: true })
        .fill("Sin indicaciones clínicas");
    await page.getByRole("button", { name: "Guardar tratamiento" }).click();
    await expect(page.locator("#main h1")).toHaveText("Plan de prueba");
    await page.goto("/doctor/patients/search");
    await page.getByLabel("Buscar registros").fill("Ana Jiménez");
    await page.getByRole("button", { name: "Asociar", exact: true }).click();
    await page.goto("/doctor/patients");
    await page.getByLabel("Buscar registros").fill("Ana Jiménez");
    await expect(page.locator("tbody tr")).toHaveCount(1);
    await page.getByRole("button", { name: "Desasociar Ana Jiménez" }).click();
    await page.locator("#dialog-confirm").click();
    await expect(page.locator("tbody tr")).toHaveCount(0);
});
test("approval, reset, reports and escaped content", async ({ page }) => {
    await page.goto("/admin/doctors/d4");
    await page.getByRole("button", { name: "Aprobar solicitud" }).click();
    await page.locator("#dialog-confirm").click();
    await expect(page.locator(".detail-heading .badge")).toHaveText("Activo");
    await page.goto("/admin/reports");
    await expect(page.locator(".report-totals")).toContainText("4");
    await page.getByRole("button", { name: "Restablecer demo" }).click();
    await page.locator("#dialog-confirm").click();
    await page.goto("/admin/doctors/d4");
    await expect(page.locator(".detail-heading .badge")).toHaveText(
        "Pendiente",
    );
    await page.goto("/admin/medicines/create");
    await page
        .getByLabel("Nombre", { exact: true })
        .fill("<img src=x onerror=alert(1)>");
    await page.getByLabel("Presentación").fill("Ejemplo");
    await page.getByLabel("Descripción", { exact: true }).fill("Texto");
    await page.getByRole("button", { name: "Guardar medicamento" }).click();
    await expect(page.locator("#main h1")).toHaveText(
        "<img src=x onerror=alert(1)>",
    );
    await expect(page.locator("#main img")).toHaveCount(0);
});
test("mobile and reduced motion maintain navigation and no viewport overflow", async ({
    page,
}) => {
    await page.setViewportSize({ width: 375, height: 812 });
    await page.emulateMedia({ reducedMotion: "reduce" });
    for (const url of [
        "/login",
        "/admin",
        "/admin/patients",
        "/doctor/treatments/create",
    ]) {
        await page.goto(url);
        await expect(page.locator("#main")).toBeVisible();
        expect(
            await page.evaluate(
                () => document.documentElement.scrollWidth <= innerWidth,
            ),
        ).toBe(true);
    }
    await page.getByRole("button", { name: "Abrir menú" }).click();
    await expect(page.locator("#sidebar")).toBeVisible();
    await page
        .locator("#sidebar")
        .getByRole("link", { name: "Citas", exact: true })
        .click();
    await expect(page.locator("#main h1")).toHaveText("Citas");
});
