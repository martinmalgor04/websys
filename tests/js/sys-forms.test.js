import { describe, expect, test } from 'bun:test';
import SysFormHandler from '../../webSyS/assets/js/sys-forms.js';

describe('SysFormHandler.parseResponse', () => {
    test('returns the payload of a successful JSON response', async () => {
        const response = Response.json({ success: true, mensaje: 'ok' });

        await expect(SysFormHandler.parseResponse(response)).resolves.toEqual({ success: true, mensaje: 'ok' });
    });

    test('throws the server error message and status for a JSON failure', async () => {
        const response = Response.json({ success: false, error: 'Demasiadas consultas' }, { status: 429 });

        const error = await SysFormHandler.parseResponse(response).catch(e => e);

        expect(error.message).toBe('Demasiadas consultas');
        expect(error.status).toBe(429);
    });

    test('throws the friendly error message when the body is not JSON', async () => {
        const response = new Response('<!DOCTYPE html><h1>Internal Server Error</h1>', { status: 500 });

        const error = await SysFormHandler.parseResponse(response).catch(e => e);

        expect(error.message).toBe(SysFormHandler.config.errorMessage);
        expect(error.status).toBe(500);
    });

    test('keeps the rate-limit status when the host answers 429 with HTML', async () => {
        const response = new Response('<html>Too Many Requests</html>', { status: 429 });

        const error = await SysFormHandler.parseResponse(response).catch(e => e);

        expect(error.status).toBe(429);
        expect(error.message).toBe(SysFormHandler.config.errorMessage);
    });
});
