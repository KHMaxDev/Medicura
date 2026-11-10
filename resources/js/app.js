import gsap from "gsap";
import {
    createIcons,
    ArrowDownUp,
    ArrowLeft,
    ArrowLeftRight,
    ArrowRight,
    ArrowUpRight,
    CalendarDays,
    ChartNoAxesCombined,
    Check,
    ChevronLeft,
    ChevronRight,
    CircleHelp,
    ClipboardPlus,
    HeartPulse,
    Hospital,
    LayoutDashboard,
    Menu,
    Pencil,
    Pill,
    Plus,
    Printer,
    RotateCcw,
    Search,
    Sparkles,
    Stethoscope,
    Sun,
    Trash2,
    UserRoundMinus,
    UserRoundPlus,
    Users,
    Activity,
} from "lucide";
const icons = {
    ArrowDownUp,
    ArrowLeft,
    ArrowLeftRight,
    ArrowRight,
    ArrowUpRight,
    CalendarDays,
    ChartNoAxesCombined,
    Check,
    ChevronLeft,
    ChevronRight,
    CircleHelp,
    ClipboardPlus,
    HeartPulse,
    Hospital,
    LayoutDashboard,
    Menu,
    Pencil,
    Pill,
    Plus,
    Printer,
    RotateCcw,
    Search,
    Sparkles,
    Stethoscope,
    Sun,
    Trash2,
    UserRoundMinus,
    UserRoundPlus,
    Users,
    Activity,
};
import "@fontsource/manrope/latin-400.css";
import "@fontsource/manrope/latin-600.css";
import "@fontsource/manrope/latin-700.css";
import "@fontsource/dm-sans/latin-400.css";
import "@fontsource/dm-sans/latin-500.css";
import {
    STORAGE_KEY,
    modules,
    initialState,
    rowsFor,
    validate,
    removeRecord,
    metrics,
    copy,
} from "./demo-store";

const icon = (name) => `<i data-lucide="${name}" aria-hidden="true"></i>`;
const esc = (value) =>
    String(value ?? "").replace(
        /[&<>"']/g,
        (c) =>
            ({
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#39;",
            })[c],
    );
const avatar = (name) =>
    `<span class="avatar">${esc(
        String(name || "?")
            .split(" ")
            .slice(0, 2)
            .map((n) => n[0])
            .join(""),
    )}</span>`;
const badge = (status) =>
    `<span class="badge ${["Activo", "Confirmada", "Completada"].includes(status) ? "positive" : status === "Pendiente" ? "pending" : "neutral"}">${esc(status)}</span>`;
const dateLabel = (date) =>
    date
        ? new Date(`${date}T12:00:00`).toLocaleDateString("es-MX", {
              day: "numeric",
              month: "short",
              year: "numeric",
          })
        : "—";
function refreshIcons() {
    createIcons({
        icons,
        attrs: { "stroke-width": 1.7, "aria-hidden": "true" },
    });
}
let toastTimer;
function toast(message) {
    const el = document.querySelector("#toast");
    el.textContent = message;
    el.hidden = false;
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => {
        el.hidden = true;
    }, 4500);
}
let motion;
const interactions = gsap.context(() => {});
function revealInteraction(element, offset = 10) {
    if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
        interactions.add(() =>
            gsap.fromTo(
                element,
                { y: offset, autoAlpha: 0 },
                {
                    y: 0,
                    autoAlpha: 1,
                    duration: 0.22,
                    ease: "power2.out",
                    overwrite: "auto",
                    clearProps: "transform,opacity,visibility",
                },
            ),
        );
    }
}
function animate(root = document) {
    motion?.revert();
    motion = gsap.matchMedia();
    motion.add("(prefers-reduced-motion: no-preference)", () => {
        const targets = root.querySelectorAll("[data-reveal]");
        if (targets.length)
            gsap.timeline({
                defaults: { duration: 0.48, ease: "power2.out" },
            }).from(targets, {
                y: 16,
                autoAlpha: 0,
                stagger: 0.055,
                clearProps: "transform,opacity,visibility",
            });
    });
}
window.addEventListener("pagehide", () => {
    motion?.revert();
    interactions.revert();
});
window.addEventListener("pageshow", () => animate());
refreshIcons();
document.querySelector("#contact-form")?.addEventListener("submit", (e) => {
    e.preventDefault();
    e.target.reset();
    toast("Demostración completada. No se ha enviado ningún correo.");
});
const app = document.querySelector("#demo-app");
if (app) startDemo();
else animate();

function startDemo() {
    const seed = window.medicuraSeed;
    let storage;
    try {
        storage = window.sessionStorage;
    } catch {
        /* Storage may be disabled. */
    }
    let state = initialState(seed, storage),
        role = app.dataset.role;
    let query = "",
        filter = "",
        sort = "asc",
        page = 1,
        printing = false;
    let dialogAction = null,
        dialogTrigger = null;
    const allowed = () =>
        role === "admin"
            ? [
                  "doctors",
                  "patients",
                  "institutions",
                  "medicines",
                  "appointments",
                  "reports",
              ]
            : ["patients", "appointments", "medicines", "treatments", "settings"];
    const route = () => {
        const p = location.pathname.split("/").filter(Boolean);
        return { module: p[1] || "dashboard", id: p[2], edit: p[3] === "edit" };
    };
    const href = (module = "", suffix = "") =>
        `/${role}${module ? "/" + module : ""}${suffix ? "/" + suffix : ""}`;
    const lookup = (module, id) => state[module].find((r) => r.id === id);
    const nameOf = (module, id) => lookup(module, id)?.name || "Sin registro";
    function persist() {
        try {
            if (!storage) throw new Error();
            storage.setItem(STORAGE_KEY, JSON.stringify(state));
            return true;
        } catch {
            toast(
                "Los cambios se mantienen solo en esta página: el almacenamiento no está disponible.",
            );
            return false;
        }
    }
    function changed(message) {
        const saved = persist();
        render();
        if (saved) toast(message);
    }
    function go(url, reset = true) {
        history.pushState({}, "", url);
        role = location.pathname.startsWith("/admin") ? "admin" : "doctor";
        if (reset) {
            query = "";
            filter = "";
            page = 1;
        }
        render();
        window.scrollTo({ top: 0, behavior: "instant" });
        document.querySelector("#main h1")?.focus({ preventScroll: true });
    }
    window.addEventListener("popstate", () => {
        role = location.pathname.startsWith("/admin") ? "admin" : "doctor";
        query = "";
        filter = "";
        page = 1;
        render();
    });
    function shell() {
        const current = route().module,
            profile =
                role === "admin"
                    ? "Alex Morgan"
                    : nameOf("doctors", state.doctorId);
        app.innerHTML = `<div class="workspace"><aside class="sidebar glass" id="sidebar" aria-label="Navegación principal">
      <a href="/login" class="brand"><img class="brand-logo" src="/logo.png" alt="" width="44" height="44">medicura<span class="brand-dot">.</span></a><div class="workspace-label">${role === "admin" ? "Administración" : "Espacio médico"}</div>
      <nav><a data-nav href="${href()}" class="nav-item ${current === "dashboard" ? "active" : ""}" ${current === "dashboard" ? 'aria-current="page"' : ""}>${icon("layout-dashboard")}<span>Resumen</span></a>
      ${allowed()
          .map(
              (k) =>
                  `<a data-nav href="${href(k)}" class="nav-item ${current === k ? "active" : ""}" ${current === k ? 'aria-current="page"' : ""}>${icon(modules[k]?.icon || "chart-no-axes-combined")}<span>${modules[k]?.title || (k === "settings" ? "Configuración" : "Reportes")}</span>${k === "doctors" && metrics(state, role).pending ? `<span class="nav-count">${metrics(state, role).pending}</span>` : ""}</a>`,
          )
          .join("")}</nav>
      <div class="sidebar-bottom"><div class="demo-note">${icon("sparkles")}<strong>Tu espacio para explorar</strong><p>Prueba cada función con datos de ejemplo.</p><button class="text-button" data-action="reset">Restablecer demo ${icon("rotate-ccw")}</button></div><a href="/login" class="nav-item">${icon("arrow-left-right")}<span>Cambiar interfaz</span></a><div class="sidebar-profile">${role === "doctor" && state.profilePhoto ? `<img class="avatar" src="${state.profilePhoto}" alt="Foto de perfil">` : avatar(profile)}<div><strong>${esc(profile)}</strong><small>${role === "admin" ? "Administrador" : "Medicina general"}</small></div></div></div>
      </aside><div class="workspace-main"><header class="topbar"><div class="topbar-left"><button class="icon-button menu-toggle" aria-label="Abrir menú" aria-controls="sidebar" aria-expanded="false" data-action="menu">${icon("menu")}</button><span>Mi espacio</span>${icon("chevron-right")}<strong>${modules[current]?.title || (current === "settings" ? "Configuración" : current === "reports" ? "Reportes" : "Resumen")}</strong></div><div class="topbar-right"><span class="demo-indicator"><span class="status-dot"></span> Modo demo</span><button class="icon-button" aria-label="Ayuda sobre la demo" data-action="help">${icon("circle-help")}</button>${role === "doctor" && state.profilePhoto ? `<img class="avatar" src="${state.profilePhoto}" alt="Foto de perfil">` : avatar(profile)}</div></header>
      <main id="main" class="page-content"></main><footer class="app-footer"><span>Medicura · El cuidado, conectado.</span><span>Datos de demostración</span></footer></div></div>
      <dialog id="confirm-dialog" class="glass" aria-labelledby="dialog-title" aria-describedby="dialog-text"><form method="dialog"><div class="dialog-icon">${icon("circle-help")}</div><h2 id="dialog-title"></h2><p id="dialog-text"></p><div class="dialog-actions"><button class="button" value="cancel">Cancelar</button><button class="button primary" id="dialog-confirm" value="confirm">Confirmar</button></div></form></dialog>`;
        const dialog = document.querySelector("#confirm-dialog");
        dialog.addEventListener("close", () => {
            const action = dialogAction;
            dialogAction = null;
            if (dialog.returnValue === "confirm") action?.();
            else dialogTrigger?.focus();
        });
    }
    function confirm(title, message, action, button = "Confirmar") {
        dialogAction = action;
        dialogTrigger = document.activeElement;
        document.querySelector("#dialog-title").textContent = title;
        document.querySelector("#dialog-text").textContent = message;
        document.querySelector("#dialog-confirm").textContent = button;
        document.querySelector("#confirm-dialog").showModal();
        revealInteraction(document.querySelector("#confirm-dialog"));
    }
    function heading(title, subtitle, actions = "") {
        return `<div class="page-heading" data-reveal><div><h1 tabindex="-1">${esc(title)}</h1><p>${esc(subtitle)}</p></div><div class="page-actions">${actions}</div></div>`;
    }
    function buttonLink(text, url, symbol = "plus", primary = true) {
        return `<a data-nav class="button ${primary ? "primary" : ""}" href="${url}">${icon(symbol)}${esc(text)}</a>`;
    }
    function empty(
        title = "No hay resultados.",
        text = "Prueba con otra búsqueda o agrega un registro.",
    ) {
        return `<div class="empty-state">${icon("search")}<h3>${esc(title)}</h3><p>${esc(text)}</p></div>`;
    }
    function dashboard() {
        const m = metrics(state, role);
        const cards =
            role === "admin"
                ? [
                      [
                          "Pacientes registrados",
                          m.patients,
                          "users",
                          "patients",
                      ],
                      ["Doctores activos", m.doctors, "stethoscope", "doctors"],
                      [
                          "Citas de hoy",
                          m.appointments,
                          "calendar-days",
                          "appointments",
                      ],
                      [
                          "Solicitudes pendientes",
                          m.pending,
                          "user-round-plus",
                          "doctors/pending",
                      ],
                  ]
                : [
                      ["Mis pacientes", m.patients, "users", "patients"],
                      [
                          "Citas de hoy",
                          m.appointments,
                          "calendar-days",
                          "appointments",
                      ],
                      [
                          "Tratamientos activos",
                          m.treatments,
                          "clipboard-plus",
                          "treatments",
                      ],
                  ];
        const agenda = rowsFor(state, "appointments", role)
            .filter((a) => a.date === state.today && a.status !== "Cancelada")
            .sort((a, b) => a.start.localeCompare(b.start));
        return (
            heading(
                role === "admin"
                    ? "Una mirada a tu comunidad."
                    : `Buen día, ${nameOf("doctors", state.doctorId).split(" ")[0]}.`,
                role === "admin"
                    ? "Todo lo que necesitas para acompañar a tu equipo."
                    : "Este es el panorama de tu día. Hagamos espacio para cuidar.",
                buttonLink("Nueva cita", href("appointments", "create")),
            ) +
            `<section class="welcome-banner glass" data-reveal><div><span class="pill">${icon("sun")} ${esc(dateLabel(state.today))}</span><h2>${role === "admin" ? "Cada conexión cuenta." : "Tu atención hace la diferencia."}</h2><p>${role === "admin" ? "Personas, equipo y atención. Todo en un mismo lugar." : "Tu agenda está lista. Tus pacientes, un poco más cerca."}</p></div><div class="banner-art" aria-hidden="true"><div class="banner-orbit"></div><span>✚</span></div></section>
    <section class="metrics-grid ${role === "doctor" ? "three" : ""}">${cards.map(([label, value, symbol, link]) => `<a data-nav href="${href(link)}" class="metric glass" data-reveal><div class="metric-top"><span>${esc(label)}</span><span class="metric-icon">${icon(symbol)}</span></div><strong>${value.toString().padStart(2, "0")}</strong><small>Ver ${link.includes("/") ? "solicitudes" : modules[link]?.title.toLowerCase()} ${icon("arrow-up-right")}</small></a>`).join("")}</section>
    <div class="dashboard-grid"><section class="glass panel" data-reveal><div class="panel-heading"><div><h2>Agenda de hoy</h2><p>${agenda.length} citas en tu jornada</p></div>${buttonLink("Ver agenda", href("appointments"), "arrow-up-right", false)}</div>${agenda.length ? `<div class="agenda">${agenda.map((a) => `<a data-nav href="${href("appointments", a.id)}" class="agenda-row"><div class="agenda-time"><strong>${esc(a.start)}</strong><small>${esc(a.end)}</small></div><span class="timeline-dot"></span>${avatar(nameOf("patients", a.patient_id))}<div class="agenda-person"><strong>${esc(nameOf("patients", a.patient_id))}</strong><small>${esc(a.reason)}</small></div>${badge(a.status)}${icon("chevron-right")}</a>`).join("")}</div>` : empty("Tu agenda está despejada.", "Crea una cita para comenzar.")}</section>
    <aside class="dashboard-aside"><section class="glass panel" data-reveal><h2>Accesos rápidos</h2><div class="quick-links">${buttonLink(role === "admin" ? "Registrar paciente" : "Buscar paciente", href("patients", role === "admin" ? "create" : "search"), "user-round-plus", false)}${buttonLink("Ver medicamentos", href("medicines"), "pill", false)}${buttonLink(role === "admin" ? "Consultar reportes" : "Nuevo tratamiento", href(role === "admin" ? "reports" : "treatments", role === "admin" ? "" : "create"), "clipboard-plus", false)}</div></section><section class="care-note" data-reveal>${icon("heart-pulse")}<h2>Pequeños detalles.<br>Mejor atención.</h2><p>Una agenda organizada deja más espacio para escuchar.</p><span>El cuidado comienza aquí</span></section></aside></div>`
        );
    }
    function displayValue(key, value) {
        if (key === "patient_id") return nameOf("patients", value);
        if (key === "doctor_id") return nameOf("doctors", value);
        if (key === "institution_id") return nameOf("institutions", value);
        if (["date", "birthdate"].includes(key)) return dateLabel(value);
        return value || "—";
    }
    const columns = {
        patients: [
            ["name", "Paciente"],
            ["email", "Correo"],
            ["phone", "Teléfono"],
            ["status", "Estado"],
        ],
        doctors: [
            ["name", "Doctor"],
            ["specialty", "Especialidad"],
            ["institution_id", "Institución"],
            ["status", "Estado"],
        ],
        institutions: [
            ["name", "Institución"],
            ["address", "Dirección"],
            ["phone", "Teléfono"],
            ["status", "Estado"],
        ],
        medicines: [
            ["name", "Medicamento"],
            ["type", "Presentación"],
            ["description", "Descripción"],
        ],
        appointments: [
            ["patient_id", "Paciente"],
            ["doctor_id", "Doctor"],
            ["date", "Fecha"],
            ["start", "Hora"],
            ["status", "Estado"],
        ],
        treatments: [
            ["name", "Tratamiento"],
            ["patient_id", "Paciente"],
            ["duration", "Días"],
            ["status", "Estado"],
        ],
    };
    function canCreate(module) {
        return (
            module !== "doctors" &&
            !(role === "doctor" && module === "patients")
        );
    }
    function listing(module, pending = false, searchPatients = false) {
        let rows = searchPatients
            ? state.patients.filter(
                  (p) =>
                      !rowsFor(state, "patients", "doctor").some(
                          (r) => r.id === p.id,
                      ),
              )
            : rowsFor(state, module, role);
        if (pending) rows = rows.filter((r) => r.status === "Pendiente");
        const statuses = [
            ...new Set(rows.map((r) => r.status).filter(Boolean)),
        ];
        let results = rows.filter(
            (r) =>
                (!filter || r.status === filter) &&
                Object.entries(r).some(([k, v]) =>
                    String(displayValue(k, v))
                        .toLocaleLowerCase("es")
                        .includes(query.toLocaleLowerCase("es")),
                ),
        );
        const sortKey = module === "appointments" ? "date" : "name";
        results.sort(
            (a, b) =>
                String(a[sortKey]).localeCompare(String(b[sortKey]), "es") *
                (sort === "asc" ? 1 : -1),
        );
        const pages = Math.max(1, Math.ceil(results.length / 8));
        page = Math.min(page, pages);
        const visible = printing
            ? results
            : results.slice((page - 1) * 8, page * 8);
        let actions = canCreate(module)
            ? buttonLink(
                  `Crear ${modules[module].singular}`,
                  href(module, "create"),
              )
            : "";
        if (module === "patients" && role === "doctor")
            actions = buttonLink(
                searchPatients ? "Mis pacientes" : "Asociar paciente",
                href(module, searchPatients ? "" : "search"),
                searchPatients ? "users" : "user-round-plus",
            );
        if (module === "doctors")
            actions = buttonLink(
                pending ? "Todos los doctores" : "Revisar solicitudes",
                href(module, pending ? "" : "pending"),
                "user-round-plus",
            );
        if (["doctors", "institutions"].includes(module))
            actions += `<button class="button" data-action="print">${icon("printer")}Imprimir / PDF</button>`;
        return (
            heading(
                searchPatients
                    ? "Encuentra a tu paciente"
                    : pending
                      ? "Solicitudes de doctores"
                      : modules[module].title,
                searchPatients
                    ? "Asocia personas a tu lista de atención."
                    : `${rows.length} registros de ejemplo. Explora y organiza la información.`,
                actions,
            ) +
            `<section class="glass data-panel" data-reveal><div class="table-toolbar"><label class="search-field">${icon("search")}<input id="table-search" aria-label="Buscar registros" placeholder="Buscar ${modules[module].title.toLowerCase()}…" value="${esc(query)}"></label><div class="table-controls">${statuses.length ? `<select id="status-filter" aria-label="Filtrar por estado"><option value="">Todos los estados</option>${statuses.map((s) => `<option ${filter === s ? "selected" : ""}>${esc(s)}</option>`).join("")}</select>` : ""}<button class="button" data-action="sort">${icon("arrow-down-up")}${sort === "asc" ? "Ascendente" : "Descendente"}</button></div></div>
    ${visible.length ? `<div class="table-scroll"><table><caption class="sr-only">${modules[module].title}</caption><thead><tr>${columns[module].map(([, label]) => `<th scope="col">${label}</th>`).join("")}<th scope="col" class="actions-cell">Acciones</th></tr></thead><tbody>${visible.map((r) => `<tr>${columns[module].map(([key], i) => `<td>${key === "status" ? badge(r[key]) : i === 0 ? `<div class="person-cell">${avatar(displayValue(key, r[key]))}<strong>${esc(displayValue(key, r[key]))}</strong></div>` : esc(displayValue(key, r[key]))}</td>`).join("")}<td><div class="row-actions">${searchPatients ? `<button class="button small" data-action="attach" data-id="${esc(r.id)}">${icon("plus")}Asociar</button>` : `<a data-nav class="icon-button" aria-label="Ver ${esc(r.name || nameOf("patients", r.patient_id))}" href="${href(module, r.id)}">${icon("arrow-up-right")}</a>${canCreate(module) ? `<a data-nav class="icon-button" aria-label="Editar ${esc(r.name || "cita")}" href="${href(module, r.id + "/edit")}">${icon("pencil")}</a>` : ""}${module !== "doctors" ? `<button class="icon-button danger" aria-label="${role === "doctor" && module === "patients" ? "Desasociar" : "Eliminar"} ${esc(r.name || "cita")}" data-action="delete" data-id="${esc(r.id)}">${icon(role === "doctor" && module === "patients" ? "user-round-minus" : "trash-2")}</button>` : ""}`}</div></td></tr>`).join("")}</tbody></table></div>` : empty()}
    <div class="pagination"><span>${results.length ? (page - 1) * 8 + 1 : 0}–${Math.min(page * 8, results.length)} de ${results.length} registros</span><div><button class="icon-button" data-action="prev" aria-label="Página anterior" ${page === 1 ? "disabled" : ""}>${icon("chevron-left")}</button><span>Página ${page} de ${pages}</span><button class="icon-button" data-action="next" aria-label="Página siguiente" ${page === pages ? "disabled" : ""}>${icon("chevron-right")}</button></div></div></section>`
        );
    }
    function recordForm(module, record) {
        if (!canCreate(module)) return missing();
        const edit = !!record;
        record ||= {
            date: state.today,
            doctor_id: state.doctorId,
            duration: "7",
        };
        return (
            heading(
                edit
                    ? `Editar ${modules[module].singular}`
                    : `Crear ${modules[module].singular}`,
                "Los cambios se guardan únicamente en esta demo.",
                buttonLink("Volver", href(module), "arrow-left", false),
            ) +
            `<form id="record-form" data-module="${module}" data-id="${esc(record.id || "")}" class="glass form-panel" novalidate data-reveal><div class="form-section-heading"><span class="role-icon teal">${icon(modules[module].icon)}</span><div><h2>Información de ${modules[module].singular}</h2><p>Completa los campos para continuar. Las notas son opcionales.</p></div></div><div class="form-errors" id="form-errors" role="alert" tabindex="-1" hidden></div><div class="form-grid">${modules[
                module
            ].fields
                .filter(([k]) => !(role === "doctor" && k === "doctor_id"))
                .map(([key, label, type = "text", source]) => {
                    const value = record[key] ?? "";
                    let field;
                    if (type === "relation" || type === "select") {
                        const options =
                            type === "select"
                                ? source.split("|").map((v) => [v, v])
                                : (source === "patients" && role === "doctor"
                                      ? rowsFor(state, "patients", role)
                                      : source === "doctors"
                                        ? state.doctors.filter(
                                              (d) => d.status === "Activo",
                                          )
                                        : state[source]
                                  ).map((r) => [r.id, r.name]);
                        field = `<select name="${key}" id="field-${key}">${type === "relation" ? '<option value="">Seleccionar…</option>' : ""}${options.map(([v, l]) => `<option value="${esc(v)}" ${value === v ? "selected" : ""}>${esc(l)}</option>`).join("")}</select>`;
                    } else if (type === "textarea")
                        field = `<textarea id="field-${key}" name="${key}" maxlength="2000" rows="3">${esc(value)}</textarea>`;
                    else
                        field = `<input id="field-${key}" name="${key}" type="${type}" value="${esc(value)}" maxlength="255" ${type === "number" ? 'min="1" max="3650" step="1"' : ""} ${key === "birthdate" ? `max="${state.today}"` : ""}>`;
                    return `<div class="field ${type === "textarea" ? "full" : ""}"><label for="field-${key}">${label}${["notes", "effects", "interactions"].includes(key) ? " <small>(opcional)</small>" : ""}</label>${field}<span class="field-error" id="error-${key}"></span></div>`;
                })
                .join(
                    "",
                )}</div><div class="form-actions"><a data-nav class="button" href="${href(module)}">Cancelar</a><button class="button primary" type="submit">${icon("check")}Guardar ${modules[module].singular}</button></div></form>`
        );
    }
    function detail(module, record) {
        if (!record) return missing();
        const title =
            record.name || `Cita de ${nameOf("patients", record.patient_id)}`;
        let actions = buttonLink("Volver", href(module), "arrow-left", false);
        if (canCreate(module))
            actions += buttonLink(
                "Editar",
                href(module, record.id + "/edit"),
                "pencil",
            );
        let extra = "";
        if (module === "doctors" && record.status === "Pendiente")
            extra = `<div class="form-actions"><button class="button" data-action="deny" data-id="${esc(record.id)}">Rechazar solicitud</button><button class="button primary" data-action="approve" data-id="${esc(record.id)}">${icon("check")}Aprobar solicitud</button></div>`;
        if (module === "patients") {
            const appointments = rowsFor(state, "appointments", role).filter(
                    (a) => a.patient_id === record.id,
                ),
                treatments = rowsFor(state, "treatments", role).filter(
                    (t) => t.patient_id === record.id,
                );
            extra = `<div class="history-grid"><section class="glass panel"><h2>Citas del paciente</h2>${appointments.length ? appointments.map((a) => `<a data-nav class="history-item" href="${href("appointments", a.id)}"><span>${esc(dateLabel(a.date))} · ${esc(a.start)}<small>${esc(a.reason)}</small></span>${badge(a.status)}</a>`).join("") : empty("Sin citas registradas.", "Crea una cita desde la agenda.")}</section><section class="glass panel"><h2>Tratamientos</h2>${treatments.length ? treatments.map((t) => `<div class="history-item"><span>${esc(t.name)}<small>${esc(t.description)}</small></span>${badge(t.status)}</div>`).join("") : empty("Sin tratamientos.", "Los tratamientos aparecerán aquí.")}</section></div>`;
        }
        return (
            heading(title, "Información de demostración", actions) +
            `<section class="glass detail-panel" data-reveal><div class="detail-heading">${avatar(title)}<div><h2>${esc(title)}</h2>${record.status ? badge(record.status) : "<p>Catálogo de demostración</p>"}</div></div><dl class="detail-grid">${modules[module].fields.map(([key, label]) => `<div><dt>${label}</dt><dd>${esc(displayValue(key, record[key]))}</dd></div>`).join("")}</dl></section>` +
            extra
        );
    }
    function settings() {
        const doctor = lookup('doctors', state.doctorId);
        return heading('Configuración', 'Administra tu foto y prueba el cambio de contraseña.') + `<section class="glass form-panel"><h2>Perfil médico</h2><p>Los datos de identidad y profesionales son de solo lectura.</p><div class="profile-photo">${state.profilePhoto ? `<img src="${state.profilePhoto}" alt="Foto de perfil" width="96" height="96">` : avatar(doctor.name)}</div><form id="photo-form"><label for="profile-photo">Foto de perfil (JPG, PNG o WebP, máximo 1 MB)</label><input id="profile-photo" type="file" accept="image/jpeg,image/png,image/webp"><p id="photo-error" role="alert"></p></form><dl class="detail-grid">${[['Nombre',doctor.name],['Correo',doctor.email],['Teléfono',doctor.phone],['Cédula',doctor.license],['Especialidad',doctor.specialty],['Institución',nameOf('institutions',doctor.institution_id)]].map(([label,value])=>`<div><dt>${label} · Solo lectura</dt><dd>${esc(value)}</dd></div>`).join('')}</dl></section><form id="password-form" class="glass form-panel settings-password"><h2>Contraseña de demostración</h2><p>Simula el cambio. No se crea una cuenta ni se almacena una contraseña.</p><div class="form-grid"><div class="field"><label for="new-password">Nueva contraseña</label><input id="new-password" type="password" minlength="8" required autocomplete="new-password"></div><div class="field"><label for="confirm-password">Confirmar contraseña</label><input id="confirm-password" type="password" required autocomplete="new-password"></div></div><p id="password-error" role="alert"></p><div class="form-actions"><button class="button primary">Actualizar contraseña</button></div></form>`;
    }
    app.addEventListener('change', async e => {
        if(e.target.id !== 'profile-photo') return;
        const file=e.target.files[0]; if(!file) return;
        const error=document.querySelector('#photo-error');
        if(!['image/jpeg','image/png','image/webp'].includes(file.type) || file.size>1024*1024){error.textContent='Selecciona una imagen JPG, PNG o WebP de hasta 1 MB.';return;}
        const reader=new FileReader();
        reader.onload=()=>{const image=new Image();image.onload=()=>{state.profilePhoto=reader.result;changed('Foto de perfil actualizada.');};image.onerror=()=>{error.textContent='No se pudo abrir la imagen.';};image.src=reader.result;};
        reader.readAsDataURL(file);
    });
    app.addEventListener('submit', e => {
        if(e.target.id !== 'password-form') return;
        e.preventDefault();
        const password=document.querySelector('#new-password').value;
        if(password!==document.querySelector('#confirm-password').value){document.querySelector('#password-error').textContent='Las contraseñas no coinciden.';return;}
        e.target.reset();document.querySelector('#password-error').textContent='';toast('Cambio de contraseña simulado. No se almacenó ninguna contraseña.');
    });
    function reports() {
        const m = metrics(state, "admin"),
            counts = ["Confirmada", "Pendiente", "Completada", "Cancelada"].map(
                (status) => [
                    status,
                    state.appointments.filter((a) => a.status === status)
                        .length,
                ],
            );
        return (
            heading(
                "Reportes",
                "Una perspectiva clara de tu comunidad.",
                `<button class="button primary" data-action="print">${icon("printer")}Imprimir / Guardar PDF</button>`,
            ) +
            `<section class="glass panel report-panel" data-reveal><div class="panel-heading"><div><h2>Resumen de actividad</h2><p>${esc(dateLabel(state.today))} · Datos de la demo actual</p></div>${icon("chart-no-axes-combined")}</div><dl class="report-totals">${[
                ["Pacientes", m.patients],
                ["Doctores activos", m.doctors],
                ["Instituciones", state.institutions.length],
                ["Medicamentos", state.medicines.length],
                ["Citas", state.appointments.length],
                ["Tratamientos", state.treatments.length],
            ]
                .map(
                    ([label, value]) =>
                        `<div><dt>${label}</dt><dd>${value}</dd></div>`,
                )
                .join(
                    "",
                )}</dl><h3>Estado de las citas</h3><div class="chart" role="img" aria-label="Citas por estado: ${counts.map(([s, n]) => `${s}: ${n}`).join(", ")}">${counts.map(([status, count]) => `<div class="chart-row"><span>${status}</span><div class="bar-track"><div class="bar-fill" style="width:${state.appointments.length ? (count / state.appointments.length) * 100 : 0}%"></div></div><strong>${count}</strong></div>`).join("")}</div><p class="report-footnote">Los totales reflejan las operaciones realizadas en esta pestaña. Usa la opción Guardar como PDF del diálogo de impresión.</p></section>`
        );
    }
    function missing() {
        return heading(
            "Registro no encontrado",
            "Puede haber sido eliminado o no pertenecer a esta lista.",
            buttonLink("Volver al resumen", href(), "arrow-left"),
        );
    }
    function render() {
        const { module, id, edit } = route();
        interactions.revert();
        shell();
        let html;
        if (module === "dashboard") html = dashboard();
        else if (!allowed().includes(module)) html = missing();
        else if (module === "settings") html = settings();
        else if (module === "reports") html = reports();
        else if (module === "doctors" && id === "pending")
            html = listing(module, true);
        else if (module === "patients" && id === "search" && role === "doctor")
            html = listing(module, false, true);
        else if (id === "pdf" && ["doctors", "institutions"].includes(module))
            html = listing(module);
        else if (id === "create") html = recordForm(module);
        else if (id) {
            const record = rowsFor(state, module, role).find(
                (r) => r.id === id,
            );
            html = record
                ? edit
                    ? recordForm(module, record)
                    : detail(module, record)
                : missing();
        } else html = listing(module);
        document.querySelector("#main").innerHTML = html;
        document.title = `${modules[module]?.title || (module === "reports" ? "Reportes" : "Resumen")} | Medicura`;
        refreshIcons();
        animate(document.querySelector("#main"));
    }
    function refreshListing() {
        const focusId = document.activeElement?.id,
            selection = document.activeElement?.selectionStart,
            { module, id } = route();
        document.querySelector("#main").innerHTML = listing(
            module,
            id === "pending",
            id === "search",
        );
        refreshIcons();
        const field = document.getElementById(focusId);
        field?.focus();
        if (field?.type === "text" && selection !== null)
            field.setSelectionRange(selection, selection);
    }
    app.addEventListener("input", (e) => {
        if (e.target.id === "table-search") {
            query = e.target.value;
            page = 1;
            refreshListing();
        }
    });
    app.addEventListener("change", (e) => {
        if (e.target.id === "status-filter") {
            filter = e.target.value;
            page = 1;
            refreshListing();
        }
    });
    app.addEventListener("click", (e) => {
        const link = e.target.closest("a[data-nav]");
        if (link && !e.ctrlKey && !e.metaKey && !e.shiftKey && e.button === 0) {
            e.preventDefault();
            go(link.getAttribute("href"));
            return;
        }
        const button = e.target.closest("[data-action]");
        if (!button) return;
        const action = button.dataset.action,
            id = button.dataset.id,
            { module } = route();
        if (action === "menu") {
            const open = document
                .querySelector("#sidebar")
                .classList.toggle("is-open");
            button.setAttribute("aria-expanded", String(open));
            button.setAttribute(
                "aria-label",
                open ? "Cerrar menú" : "Abrir menú",
            );
            if (open) revealInteraction(document.querySelector("#sidebar"), -8);
        }
        if (action === "sort") {
            sort = sort === "asc" ? "desc" : "asc";
            refreshListing();
        }
        if (action === "prev") {
            page--;
            refreshListing();
        }
        if (action === "next") {
            page++;
            refreshListing();
        }
        if (action === "print") window.print();
        if (action === "help")
            confirm(
                "Explora con libertad",
                "Esta demo usa datos ficticios. Los cambios se conservan en esta pestaña. Puedes cambiar de interfaz y restablecer los datos cuando quieras.",
                () => {},
                "Entendido",
            );
        if (action === "reset")
            confirm(
                "¿Restablecer la demo?",
                "Se descartarán todos los cambios de esta pestaña y volverán los datos de ejemplo.",
                () => {
                    state = copy(seed);
                    query = "";
                    filter = "";
                    page = 1;
                    changed("Demo restablecida.");
                },
                "Restablecer",
            );
        if (action === "attach") {
            if (
                !state.links.some(
                    (l) =>
                        l.doctor_id === state.doctorId && l.patient_id === id,
                )
            )
                state.links.push({ doctor_id: state.doctorId, patient_id: id });
            changed("Paciente asociado a tu lista.");
        }
        if (action === "approve" || action === "deny")
            confirm(
                action === "approve"
                    ? "¿Aprobar solicitud?"
                    : "¿Rechazar solicitud?",
                "Se actualizará el estado en esta demo. No se enviarán correos.",
                () => {
                    const doctor = lookup("doctors", id);
                    if (doctor?.status === "Pendiente") {
                        doctor.status =
                            action === "approve" ? "Activo" : "Rechazado";
                        changed("Solicitud actualizada.");
                    }
                },
            );
        if (action === "delete") {
            const detach = role === "doctor" && module === "patients";
            if (
                module === "institutions" &&
                state.doctors.some((d) => d.institution_id === id)
            ) {
                toast(
                    "Esta institución tiene doctores asociados y no se puede eliminar.",
                );
                return;
            }
            confirm(
                detach
                    ? "¿Retirar de tu lista?"
                    : `¿Eliminar ${modules[module].singular}?`,
                detach
                    ? "El expediente y su historial se conservarán."
                    : module === "patients"
                      ? "También se eliminarán sus citas, tratamientos y asociaciones de la demo."
                      : "Este registro se eliminará de la demo.",
                () => {
                    if (detach)
                        state.links = state.links.filter(
                            (l) =>
                                !(
                                    l.doctor_id === state.doctorId &&
                                    l.patient_id === id
                                ),
                        );
                    else removeRecord(state, module, id);
                    changed(
                        detach
                            ? "Paciente retirado de tu lista."
                            : "Registro eliminado.",
                    );
                },
                detach ? "Retirar" : "Eliminar",
            );
        }
    });
    app.addEventListener("submit", (e) => {
        if (e.target.id !== "record-form") return;
        e.preventDefault();
        const form = e.target,
            module = form.dataset.module;
        const record = Object.fromEntries(
            [...new FormData(form).entries()].map(([k, v]) => [
                k,
                String(v).trim(),
            ]),
        );
        record.id = form.dataset.id || crypto.randomUUID();
        if (
            ["appointments", "treatments"].includes(module) &&
            role === "doctor"
        )
            record.doctor_id = state.doctorId;
        const errors = validate(state, module, record, role);
        form.querySelectorAll("[aria-invalid]").forEach((el) => {
            el.removeAttribute("aria-invalid");
            el.removeAttribute("aria-describedby");
        });
        form.querySelectorAll(".field-error").forEach(
            (el) => (el.textContent = ""),
        );
        const summary = document.querySelector("#form-errors");
        summary.hidden = !Object.keys(errors).length;
        if (Object.keys(errors).length) {
            summary.textContent = "Revisa los campos indicados para guardar.";
            for (const [key, message] of Object.entries(errors)) {
                const field = form.elements.namedItem(key);
                if (field) {
                    field.setAttribute("aria-invalid", "true");
                    field.setAttribute("aria-describedby", `error-${key}`);
                    document.getElementById(`error-${key}`).textContent =
                        message;
                }
            }
            summary.focus();
            return;
        }
        const index = state[module].findIndex((r) => r.id === record.id);
        if (index < 0) state[module].push(record);
        else state[module][index] = record;
        const saved = persist();
        go(href(module, record.id));
        if (saved) toast("Cambios guardados en la demo.");
    });
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            document.querySelector("#sidebar")?.classList.remove("is-open");
            document
                .querySelector('[data-action="menu"]')
                ?.setAttribute("aria-expanded", "false");
        }
    });
    window.addEventListener("beforeprint", () => {
        printing = true;
        render();
        motion?.revert();
    });
    window.addEventListener("afterprint", () => {
        printing = false;
        render();
    });
    render();
}
