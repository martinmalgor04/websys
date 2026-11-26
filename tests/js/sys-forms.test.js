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

describe('SysFormHandler.getErrorMessage', () => {
    test('uses the friendly message when fetch fails with a browser network error', () => {
        expect(SysFormHandler.getErrorMessage(new TypeError('Failed to fetch'))).toBe(SysFormHandler.config.errorMessage);
    });

    test('keeps the message of an error built from the server response', async () => {
        const response = Response.json({ success: false, error: 'El email no es válido' }, { status: 400 });
        const error = await SysFormHandler.parseResponse(response).catch(e => e);

        expect(SysFormHandler.getErrorMessage(error)).toBe('El email no es válido');
    });

    test('keeps a plain string message', () => {
        expect(SysFormHandler.getErrorMessage('Completá el formulario')).toBe('Completá el formulario');
    });

    test('uses the friendly message when there is no usable error', () => {
        expect(SysFormHandler.getErrorMessage(null)).toBe(SysFormHandler.config.errorMessage);
        expect(SysFormHandler.getErrorMessage({ status: 400, text: 'Bad Request' })).toBe(SysFormHandler.config.errorMessage);
    });
});
