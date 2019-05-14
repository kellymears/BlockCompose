import { __ } from '@wordpress/i18n'
import { RichText } from '@wordpress/editor'

const edit = (props) => {
  const {
    className,
    setAttributes,
    attributes
  } = props

  return (
    <div className={className}>
      <div className="card">
        <img className="card-image" src="https://source.unsplash.com/1000x600" />
        <div className="card-content">
          <RichText
            tagName="div"
            className="card-content__heading"
            value={attributes.heading}
            placeholder={__('Heading', 'sage')}
            onChange={value => { setAttributes({ heading: value }) }} />

          <RichText
            tagName="div"
            className="card-content__copy"
            value={attributes.copy}
            placeholder={__('Copy go here', 'sage')}
            onChange={value => { setAttributes({ copy: value }) }} />
        </div>
      </div>
    </div>
  )
}

export { edit }
