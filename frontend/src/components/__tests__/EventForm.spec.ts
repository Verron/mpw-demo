import {describe, it, expect} from 'vitest'
import {mount} from '@vue/test-utils'
import EventForm from '../EventForm.vue'
import {createTestingPinia} from "@pinia/testing";
import {vi} from 'vitest';

describe('Form', () => {
    it('renders properly', () => {
        const wrapper = mount(EventForm, {
            props: {title: 'Register Test'},
            plugins: [createTestingPinia({
                createSpy: vi.fn,
                initialState: {
                    name: 'John Doe',
                    email: 'john.doe@testing.com',
                    date: '2021-01-01',
                    type: 'birthday',
                    details: "This is a test",
                    newsletter: true,
                }
            })],
        })
        expect(wrapper.text()).toContain('Register Test')
    })
})
