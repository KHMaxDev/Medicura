export const STORAGE_KEY = "medicura.demo.v1";
export const modules = {
    patients: {
        title: "Pacientes",
        singular: "paciente",
        icon: "users",
        fields: [
            ["name", "Nombre completo"],
            ["email", "Correo electrónico", "email"],
            ["phone", "Teléfono", "tel"],
            ["birthdate", "Fecha de nacimiento", "date"],
            ["gender", "Género", "select", "Femenino|Masculino|No especifica"],
            ["curp", "CURP de ejemplo"],
            ["status", "Estado", "select", "Activo|Inactivo"],
            ["notes", "Notas", "textarea"],
        ],
    },
    doctors: {
        title: "Doctores",
        singular: "doctor",
        icon: "stethoscope",
        fields: [
            ["name", "Nombre completo"],
            ["email", "Correo electrónico", "email"],
            ["specialty", "Especialidad"],
            ["institution_id", "Institución", "relation", "institutions"],
            ["phone", "Teléfono"],
            ["license", "Cédula de ejemplo"],
            ["status", "Estado", "select", "Activo|Pendiente|Rechazado"],
        ],
    },
    institutions: {
        title: "Instituciones",
        singular: "institución",
        icon: "hospital",
        fields: [
            ["name", "Nombre"],
            ["address", "Dirección"],
            ["phone", "Teléfono", "tel"],
            ["email", "Correo electrónico", "email"],
            ["status", "Estado", "select", "Activo|Inactivo"],
        ],
    },
    medicines: {
        title: "Medicamentos",
        singular: "medicamento",
        icon: "pill",
        fields: [
            ["name", "Nombre"],
            ["type", "Presentación"],
            ["description", "Descripción", "textarea"],
            ["effects", "Efectos secundarios", "textarea"],
            ["interactions", "Interacciones", "textarea"],
        ],
    },
    appointments: {
        title: "Citas",
        singular: "cita",
        icon: "calendar-days",
        fields: [
            ["patient_id", "Paciente", "relation", "patients"],
            ["doctor_id", "Doctor", "relation", "doctors"],
            ["date", "Fecha", "date"],
            ["start", "Hora de inicio", "time"],
            ["end", "Hora de fin", "time"],
            ["reason", "Motivo"],
            [
                "status",
                "Estado",
                "select",
                "Confirmada|Pendiente|Completada|Cancelada",
            ],
            ["notes", "Notas", "textarea"],
        ],
    },
    treatments: {
        title: "Tratamientos",
        singular: "tratamiento",
        icon: "clipboard-plus",
        fields: [
            ["name", "Nombre del tratamiento"],
            ["patient_id", "Paciente", "relation", "patients"],
            ["date", "Fecha de inicio", "date"],
            ["duration", "Duración (días)", "number"],
            ["dose", "Dosis de ejemplo"],
            ["description", "Descripción", "textarea"],
            ["status", "Estado", "select", "Activo|Finalizado"],
        ],
    },
};
export const copy = (value) => structuredClone(value);
export function initialState(seed, storage) {
    try {
        const saved = JSON.parse(storage?.getItem(STORAGE_KEY) || "null");
        if (
            saved?.version === seed.version &&
            [
                "doctors",
                "patients",
                "institutions",
                "medicines",
                "appointments",
                "treatments",
                "links",
            ].every(
                (k) =>
                    Array.isArray(saved[k]) &&
                    saved[k].every(
                        (r) => r && typeof r === "object" && !Array.isArray(r),
                    ),
            )
        )
            return saved;
    } catch {
        /* Corrupt or inaccessible storage falls back to the fixtures. */
    }
    return copy(seed);
}
export function rowsFor(state, module, role) {
    if (role !== "doctor") return state[module];
    if (module === "patients")
        return state.patients.filter((p) =>
            state.links.some(
                (l) => l.doctor_id === state.doctorId && l.patient_id === p.id,
            ),
        );
    if (["appointments", "treatments"].includes(module))
        return state[module].filter((r) => r.doctor_id === state.doctorId);
    return state[module];
}
export function validate(state, module, record, role = "admin") {
    const errors = {};
    for (const [key, label, type, source] of modules[module].fields) {
        const value = String(record[key] ?? "").trim();
        if (!value && !["notes", "effects", "interactions"].includes(key))
            errors[key] = `Completa ${label.toLowerCase()}.`;
        if (value.length > (type === "textarea" ? 2000 : 255))
            errors[key] = "El texto es demasiado largo.";
        if (
            type === "email" &&
            value &&
            !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)
        )
            errors[key] = "Escribe un correo válido.";
        if (type === "select" && !source.split("|").includes(value))
            errors[key] = "Selecciona una opción válida.";
        if (type === "relation" && !state[source].some((r) => r.id === value))
            errors[key] = "Selecciona un registro existente.";
        if (
            type === "date" &&
            (!/^\d{4}-\d{2}-\d{2}$/.test(value) ||
                Number.isNaN(Date.parse(value)) ||
                new Date(value).toISOString().slice(0, 10) !== value)
        )
            errors[key] = "Selecciona una fecha válida.";
        if (type === "time" && !/^([01]\d|2[0-3]):[0-5]\d$/.test(value))
            errors[key] = "Selecciona una hora válida.";
    }
    if (
        record.email &&
        state[module].some(
            (r) =>
                r.id !== record.id &&
                r.email?.toLowerCase() === record.email.toLowerCase(),
        )
    )
        errors.email = "Este correo ya está registrado en la demo.";
    if (module === "patients") {
        if (record.birthdate > state.today)
            errors.birthdate =
                "La fecha de nacimiento no puede estar en el futuro.";
        if (
            state.patients.some(
                (r) =>
                    r.id !== record.id &&
                    r.curp?.toLowerCase() === record.curp?.toLowerCase(),
            )
        )
            errors.curp = "Esta CURP ya está registrada.";
    }
    if (module === "appointments") {
        if (
            !state.doctors.some(
                (d) => d.id === record.doctor_id && d.status === "Activo",
            )
        )
            errors.doctor_id = "Selecciona un doctor activo.";
        if (record.end <= record.start)
            errors.end = "La hora final debe ser posterior al inicio.";
        if (
            record.status !== "Cancelada" &&
            state.appointments.some(
                (a) =>
                    a.id !== record.id &&
                    a.status !== "Cancelada" &&
                    a.date === record.date &&
                    a.start < record.end &&
                    a.end > record.start &&
                    (a.doctor_id === record.doctor_id ||
                        a.patient_id === record.patient_id),
            )
        )
            errors.start =
                "El doctor o paciente ya tiene una cita en ese horario.";
    }
    if (
        module === "treatments" &&
        (!Number.isInteger(Number(record.duration)) ||
            +record.duration < 1 ||
            +record.duration > 3650)
    )
        errors.duration = "Introduce de 1 a 3650 días.";
    if (
        role === "doctor" &&
        ["appointments", "treatments"].includes(module) &&
        !rowsFor(state, "patients", role).some(
            (p) => p.id === record.patient_id,
        )
    )
        errors.patient_id =
            "Asocia este paciente a tu lista antes de continuar.";
    return errors;
}
export function removeRecord(state, module, id) {
    state[module] = state[module].filter((r) => r.id !== id);
    if (module === "patients") {
        state.links = state.links.filter((l) => l.patient_id !== id);
        for (const key of ["appointments", "treatments"])
            state[key] = state[key].filter((r) => r.patient_id !== id);
    }
}
export function metrics(state, role) {
    const appointments = rowsFor(state, "appointments", role);
    return {
        patients: rowsFor(state, "patients", role).length,
        appointments: appointments.filter(
            (a) => a.date === state.today && a.status !== "Cancelada",
        ).length,
        doctors: state.doctors.filter((d) => d.status === "Activo").length,
        pending: state.doctors.filter((d) => d.status === "Pendiente").length,
        treatments: rowsFor(state, "treatments", role).filter(
            (t) => t.status === "Activo",
        ).length,
    };
}
