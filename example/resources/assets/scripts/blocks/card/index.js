import { __ } from '@wordpress/i18n'
import { registerBlockType } from '@wordpress/blocks'

import { edit } from './edit'

const supports = {
  align: true,
}

const attributes = {
  heading: {
    type: 'string',
  },
  copy: {
    type: 'string',
  },
}

registerBlockType('sage/card', {
  title: __('Card', 'sage'),
  icon: 'wordpress',
  category: 'app',
  attributes,
  edit: edit,
  save: () => { return null },
  supports,
})
