var el = wp.element.createElement;

wp.blocks.registerBlockType('gutenberg-notice-block/block1-image-content', {
	title: 'Contact image content',		
	icon: 'format-image',	
	category: 'common',	
	attributes: {
		title: { type: 'string' },			
		content: { type: 'array', source: 'children', selector: 'p' },
		imageUrl: { type: 'string' }, // New attribute for image URL
		imagePosition: { type: 'string', default: 'left' } // New attribute for image position
	},
	edit: function(props) {
		function updateTitle( event ) {
			props.setAttributes( { title: event.target.value } );
		}

		function updateContent( newdata ) {
			props.setAttributes( { content: newdata } );
		}

		function updateImagePosition( newPosition ) {
			props.setAttributes( { imagePosition: newPosition } );
		}

		function onSelectImage( media ) {
			props.setAttributes( { imageUrl: media.url } );
		}

		return el( 'div', 
			{ 
				className: 'notice-box notice-' + props.attributes.type
			}, 
			
			el( 'div', { className: 'notice-content' }, 
				props.attributes.imagePosition === 'left' && el(
					'div', { className: 'image-left' },
					el( wp.editor.MediaUpload, {
						onSelect: onSelectImage,
						allowedTypes: 'image',
						value: props.attributes.imageUrl,
						render: function( obj ) {
							return el( wp.components.Button, {
								className: 'components-button button button-large',
								onClick: obj.open
							}, 'Select Image' );
						}
					} )
				),
				props.attributes.imagePosition === 'right' && el(
					'div', { className: 'image-right' },
					el( wp.editor.MediaUpload, {
						onSelect: onSelectImage,
						allowedTypes: 'image',
						value: props.attributes.imageUrl,
						render: function( obj ) {
							return el( wp.components.Button, {
								className: 'components-button button button-large',
								onClick: obj.open
							}, 'Select Image' );
						}
					} )
				),
				el( 'div', { className: 'text-' },// + props.attributes.imagePosition
					el(
						'input', 
						{
							type: 'text', 
							placeholder: 'Write your heading here...',
							value: props.attributes.title,
							onChange: updateTitle,
							style: { width: '100%' }
						}
					),
					el(
						wp.editor.RichText,
						{
							tagName: 'p',
							onChange: updateContent,
							value: props.attributes.content,
							placeholder: 'Write your description here...'
						}
					),
				)
			),
			el(
				'select', 
				{
					onChange: function( event ) {
						updateImagePosition( event.target.value );
					},
					value: props.attributes.imagePosition,
				},
				el("option", {value: "left" }, "Image Left"),
				el("option", {value: "right" }, "Image Right")
			)
		);
	},
	save: function(props) {
		var imageCol, contentCol;
		
		if (props.attributes.imagePosition === 'left') {
			imageCol = el( 'div', { className: 'col-lg-6' },
				el( 'div', { className: 'img-wrap' },
					el( 'img', { src: props.attributes.imageUrl, alt: 'contact-image' } )
				)
			);

			contentCol = el( 'div', { className: 'col-lg-6' },
				el( 'div', { className: 'content-right' },
					el( 'h2', null, props.attributes.title ),
					el( wp.editor.RichText.Content, { tagName: 'p', value: props.attributes.content } )
				)
			);
		} else {
			imageCol = el( 'div', { className: 'col-lg-6' },
				el( 'div', { className: 'img-wrap' },
					el( 'img', { src: props.attributes.imageUrl, alt: 'contact-image' } )
				)
			);

			contentCol = el( 'div', { className: 'col-lg-6' },
				el( 'div', { className: 'content-left' },
					el( 'h2', null, props.attributes.title ),
					el( wp.editor.RichText.Content, { tagName: 'p', value: props.attributes.content } )
				)
			);
		}

		return el( 'section', { className: 'module-right' },
			el( 'div', { className: 'container-fluid' },
				el( 'div', { className: 'row' },
					props.attributes.imagePosition === 'left' ? [imageCol, contentCol] : [contentCol,imageCol ]
				)
			)
		);
	}
});