var el = wp.element.createElement;

wp.blocks.registerBlockType('gutenberg-notice-block/block2-heading', {
    title: 'Custom Heading',
    icon: 'heading', // Correct icon name, you can use any Dashicon name here
    category: 'common',
    attributes: {
        heading: { type: 'string' },
        subheading: { type: 'array', source: 'children', selector: 'p' },
        headingType: { type: 'string', default: 'h1' },
        headingClass: { type: 'string', default: '' }, // Added for heading class
        textColor: { type: 'string', default: '#222' } // Added for text color
    },
    edit: function(props) {
        function updateHeading(event) {
            props.setAttributes({ heading: event.target.value });
        }

        function updateSubheading(newdata) {
            props.setAttributes({ subheading: newdata.target.value });
        }

        function updateHeadingType(newType) {
            props.setAttributes({ headingType: newType });
        }

        function updateHeadingClass(newClass) {
            props.setAttributes({ headingClass: newClass });
        }

        function updateTextColor(newColor) {
            props.setAttributes({ textColor: newColor });
        }

        return el('div', {
                className: 'Heading -' + props.attributes.type
            },
            el('input', {
                type: 'text',
                placeholder: 'Write your title here...',
                value: props.attributes.heading,
                onChange: updateHeading,
                style: { width: '100%' }
            }),
            el('textarea', {
                placeholder: 'Write your subheading here...',
                value: props.attributes.subheading,
                onChange: updateSubheading,
                style: { width: '100%', marginTop: '20px' }
            }),
            el('select', {
                value: props.attributes.headingType,
                onChange: (event) => updateHeadingType(event.target.value),
                style: { marginTop: '20px' }
            },
            el('option', { value: 'h1' }, 'h1'),
            el('option', { value: 'h2' }, 'h2'),
            el('option', { value: 'h3' }, 'h3'),
            el('option', { value: 'h4' }, 'h4')
            ),
            el('input', {
                type: 'text',
                placeholder: 'Enter CSS class for heading...',
                value: props.attributes.headingClass,
                onChange: (event) => updateHeadingClass(event.target.value),
                style: { width: '100%', marginTop: '20px' }
            }),
            el('input', {
                type: 'color',
                value: props.attributes.textColor,
                onChange: (event) => updateTextColor(event.target.value),
                style: { marginTop: '20px' }
            })
        );
    },
    save: function(props) {
        return el('section', { className: 'heading heading-block' },
            el('div', { className: 'row' },
                el('div', { className: 'col-lg-12 col-xl-6 col-md-12 col-sm-12' },
                    el('div', { className: 'about_sec' },
                        el('div', { className: 'line' }, '&nbsp;'),
                        el(props.attributes.headingType, {
                            className: props.attributes.headingClass,
                            style: { color: props.attributes.textColor },
                            dangerouslySetInnerHTML: { __html: props.attributes.heading }
                        }),
                        el('p', { className: 'wow slideInUp' }, props.attributes.subheading),
                    )
                )
            )
        );
    }
});
