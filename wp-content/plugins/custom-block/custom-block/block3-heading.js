var el = wp.element.createElement;

wp.blocks.registerBlockType('gutenberg-notice-block/block3-heading', {
    title: 'Custom Heading2',
    icon: 'heading', // Correct icon name, you can use any Dashicon name here
    category: 'common',
    attributes: {
        heading: { type: 'string' },
        subheading: { type: 'array', source: 'children', selector: 'p' },
        buttonText: { type: 'string' }, // New attribute for button URL
		buttonUrl: { type: 'string' }, // New attribute for button URL
        buttonText2: { type: 'string' }, // New attribute for button URL
		buttonUrl2: { type: 'string' }, // New attribute for button URL
    },
    edit: function(props) {
        function updateHeading(event) {
            props.setAttributes({ heading: event.target.value });
        }

        function updateSubheading(newdata) {
            props.setAttributes({ subheading: newdata.target.value });
        }

        function updateButtonUrl(event) {
			props.setAttributes({ buttonUrl: event.target.value });
		}
		function updateButtonText(event) {
			props.setAttributes({ buttonText: event.target.value });
		}
        function updateButtonUrl2(event) {
			props.setAttributes({ buttonUrl2: event.target.value });
		}
		function updateButtonText2(event) {
			props.setAttributes({ buttonText2: event.target.value });
		}
        return el('div', {
                className: 'Heading -' + props.attributes.type
            },
            el('input', {
                type: 'text',
                placeholder: 'Write your title here...',
                value: props.attributes.heading,
                onChange: updateHeading,
                style: { width: '100%'  }
            }),
            el('textarea', { // Changed type to textarea
                placeholder: 'Write your subheading here...',
                value: props.attributes.subheading,
                onChange: updateSubheading,
                style: { width: '100%', marginTop:'10px' }
            }),
            el('div', { className: 'button_area' },
                wp.element.createElement('input', {
                    type: 'text',
                    placeholder: 'Button Text',
                    value: props.attributes.buttonText,
                    onChange: updateButtonText,
                    style: { width: '40%', float:"left" }
                }),
                wp.element.createElement('input', {
                    type: 'text',
                    placeholder: 'Button URL',
                    value: props.attributes.buttonUrl,
                    onChange: updateButtonUrl,
                    style: { width: '40%' }
                }),
            ),
            el('div', { className: 'button_area' },

                wp.element.createElement('input', {
                    type: 'text',
                    placeholder: 'Button Text',
                    value: props.attributes.buttonText2,
                    onChange: updateButtonText2,
                    style: { width: '40%', float:"left" }
                }),
                wp.element.createElement('input', {
                    type: 'text',
                    placeholder: 'Button URL',
                    value: props.attributes.buttonUrl2,
                    onChange: updateButtonUrl2,
                    style: { width: '40%' }
                }),
            )
        );
    },
    save: function(props) {
        return el('section', { className: 'about1' },
            el('div', { className: 'row' },
                el('div', { className: 'col-lg-12 col-xl-6 col-md-12 col-sm-12' },
                    el('div', { className: 'about_sec' },
                        el('div', { className: 'line' }, '&nbsp;'),
                        el('h1', null, props.attributes.heading),
                        props.attributes.subheading ? el('p', { className: 'wow slideInUp' }, props.attributes.subheading):'',
                        el('div', { className: 'inline_btn' },
                            props.attributes.buttonUrl ? el('a', { href: props.attributes.buttonUrl,  className: 'btn custom-btn' },props.attributes.buttonText?props.attributes.buttonText:'Kontakt os') : '',
                            props.attributes.buttonUrl2 ? el('a', { href: props.attributes.buttonUrl2,  className: 'btn hover-btn ' },props.attributes.buttonText2?props.attributes.buttonText2:'Kontakt os') : ''
                        )
                    )
                )
            )  
        );
    }
});