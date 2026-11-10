import test from "node:test";
import assert from "node:assert/strict";
import {
    initialState,
    rowsFor,
    validate,
    removeRecord,
    metrics,
} from "../../resources/js/demo-store.js";
const fixture = () => ({
    version: 1,
    today: "2026-11-09",
    doctorId: "d1",
    doctors: [
        { id: "d1", status: "Activo" },
        { id: "d2", status: "Activo" },
    ],
    patients: [{ id: "p1", email: "a@example.test" }, { id: "p2" }],
    links: [{ doctor_id: "d1", patient_id: "p1" }],
    institutions: [],
    medicines: [],
    treatments: [
        { id: "t1", patient_id: "p1", doctor_id: "d1", status: "Activo" },
    ],
    appointments: [
        {
            id: "a1",
            doctor_id: "d1",
            patient_id: "p1",
            date: "2026-11-09",
            start: "09:00",
            end: "10:00",
            reason: "Consulta",
            status: "Confirmada",
        },
    ],
});
test("corrupt or unavailable storage falls back to independent seed", () => {
    const seed = fixture();
    const result = initialState(seed, {
        getItem() {
            throw Error();
        },
    });
    result.patients.pop();
    assert.equal(seed.patients.length, 2);
    assert.deepEqual(initialState(seed, { getItem: () => "{bad" }), seed);
    assert.deepEqual(
        initialState(seed, {
            getItem: () => JSON.stringify({ ...seed, patients: [null] }),
        }),
        seed,
    );
});
test("doctor views and metrics are scoped to the demo doctor", () => {
    const state = fixture();
    assert.equal(rowsFor(state, "patients", "doctor").length, 1);
    assert.equal(rowsFor(state, "patients", "admin").length, 2);
    assert.equal(metrics(state, "doctor").appointments, 1);
});
test("overlaps check doctor AND patient but allow adjacent times and cancelled appointments", () => {
    const state = fixture(),
        record = {
            ...state.appointments[0],
            id: "new",
            start: "09:30",
            end: "10:30",
        };
    assert.ok(validate(state, "appointments", record).start);
    assert.ok(
        validate(state, "appointments", { ...record, doctor_id: "d2" }).start,
    );
    assert.deepEqual(
        validate(state, "appointments", {
            ...record,
            start: "10:00",
            end: "11:00",
        }),
        {},
    );
    assert.deepEqual(
        validate(state, "appointments", { ...record, status: "Cancelada" }),
        {},
    );
    assert.ok(validate(state, "appointments", { ...record, end: "08:00" }).end);
});
test("doctor cannot assign an unassociated patient; current record can be edited", () => {
    const state = fixture();
    assert.ok(
        validate(
            state,
            "appointments",
            { ...state.appointments[0], patient_id: "p2" },
            "doctor",
        ).patient_id,
    );
    assert.deepEqual(
        validate(state, "appointments", state.appointments[0], "doctor"),
        {},
    );
});
test("removing patient cascades to related demo entities and metrics", () => {
    const state = fixture();
    removeRecord(state, "patients", "p1");
    assert.equal(state.links.length, 0);
    assert.equal(state.appointments.length, 0);
    assert.equal(state.treatments.length, 0);
    assert.equal(metrics(state, "doctor").patients, 0);
});
