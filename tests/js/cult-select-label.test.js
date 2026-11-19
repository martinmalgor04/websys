import { describe, expect, test } from 'bun:test';
import cult from '../../webSyS/assets/js/cult.js';

function fakeEl(attrs = {}) {
    const el = {
        id: attrs.id || '',
        attrs: {},
        listeners: {},
        focused: false,
        setAttribute(name, value) { this.attrs[name] = String(value); },
        getAttribute(name) { return name in this.attrs ? this.attrs[name] : null; },
        addEventListener(type, fn) { (this.listeners[type] ||= []).push(fn); },
        focus() { this.focused = true; },
    };
    return el;
}

function fakeDoc(labelsByFor) {
    return {
        querySelector(selector) {
            const match = /^label\[for="(.+)"\]$/.exec(selector);
            return match ? labelsByFor[match[1]] || null : null;
        },
    };
}

describe('cult.linkSelectLabel', () => {
    test('labels the trigger with the existing <label for> and the current value', () => {
        const label = fakeEl();
        const select = fakeEl({ id: 'asunto' });
        const trigger = fakeEl();
        const valueEl = fakeEl();

        cult.linkSelectLabel(select, trigger, valueEl, fakeDoc({ asunto: label }));

        expect(label.id).toBe('asunto-label');
        expect(valueEl.id).toBe('asunto-value');
        expect(trigger.getAttribute('aria-labelledby')).toBe('asunto-label asunto-value');
    });

    test('keeps an id the label already has', () => {
        const label = fakeEl({ id: 'lbl-asunto' });
        const trigger = fakeEl();

        cult.linkSelectLabel(fakeEl({ id: 'asunto' }), trigger, fakeEl(), fakeDoc({ asunto: label }));

        expect(trigger.getAttribute('aria-labelledby')).toBe('lbl-asunto asunto-value');
    });

    test('clicking the label focuses the visible trigger instead of the hidden select', () => {
        const label = fakeEl();
        const trigger = fakeEl();
        cult.linkSelectLabel(fakeEl({ id: 'asunto' }), trigger, fakeEl(), fakeDoc({ asunto: label }));

        let prevented = false;
        label.listeners.click.forEach(fn => fn({ preventDefault() { prevented = true; } }));

        expect(prevented).toBe(true);
        expect(trigger.focused).toBe(true);
    });

    test('does not point aria-labelledby at a missing element', () => {
        const trigger = fakeEl();

        cult.linkSelectLabel(fakeEl({ id: 'asunto' }), trigger, fakeEl(), fakeDoc({}));
        cult.linkSelectLabel(fakeEl(), trigger, fakeEl(), fakeDoc({}));

        expect(trigger.getAttribute('aria-labelledby')).toBeNull();
    });
});
