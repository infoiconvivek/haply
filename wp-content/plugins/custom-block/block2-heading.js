var el = wp.element.createElement;

wp.blocks.registerBlockType('gutenberg-notice-block/block2-heading', {
    title: 'Custom Heading',
    icon: 'heading', // Correct icon name, you can use any Dashicon name here
    category: 'common',
    attributes: {
        heading: { type: 'string' },
        subheading: { type: 'array', source: 'children', selector: 'p' },
    },
    edit: function(props) {
        function updateHeading(event) {
            props.setAttributes({ heading: event.target.value });
        }

        function updateSubheading(newdata) {
            props.setAttributes({ subheading: newdata.target.value });
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
            el('textarea', { // Changed type to textarea
                placeholder: 'Write your subheading here...',
                value: props.attributes.subheading,
                onChange: updateSubheading,
                style: { width: '100%' }
            }),
        );
    },
    save: function(props) {
        return el('section', { className: 'heading' },
            el('div', { className: 'container-fluid' },
                el('div', { className: 'row' },
                    el('div', { className: 'col-lg-8' },
                        el('div', { className: 'about_sec' },
                            el('div', { className: 'line' }),
                            el('h1', null, props.attributes.heading),
                            el('p', { className: 'wow slideInUp' }, props.attributes.subheading),
                        )
                    )
                )
            )
        );
    }
});