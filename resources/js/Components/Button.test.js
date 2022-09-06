import { render, screen } from '@testing-library/vue'
import BaseButton from './Button.vue'

test('renders base button', () => {

    const options = {
        slots: {
            default: 'Test Label'
        }
    }

    render(BaseButton, options)


    //screen.debug()
    screen.getByText('Test Label')
})
