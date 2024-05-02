var el = wp.element.createElement;

wp.blocks.registerBlockType('gutenberg-notice-block/block1-image-content-home', {
	title: 'Home image with content',		
	icon: 'format-image',	
	category: 'common',	
	attributes: {
		title: { type: 'string' },			
		content: { type: 'array', source: 'children', selector: 'p' },
		imageUrl: { type: 'string' }, // New attribute for image URL
		imagePosition: { type: 'string', default: 'left' }, // New attribute for image position
		buttonText: { type: 'string' }, // New attribute for button URL
		buttonUrl: { type: 'string' }, // New attribute for button URL
		
	},
	edit: function(props) {
		function updateTitle(event) {
			props.setAttributes({ title: event.target.value });
		}
	
		function updateContent(newdata) {
			props.setAttributes({ content: newdata });
		}
	
		function updateImagePosition(newPosition) {
			props.setAttributes({ imagePosition: newPosition });
		}
	
		function onSelectImage(media) {
			props.setAttributes({ imageUrl: media.url });
		}

		function updateButtonUrl(event) {
			props.setAttributes({ buttonUrl: event.target.value });
		}
		function updateButtonText(event) {
			props.setAttributes({ buttonText: event.target.value });
		}

		
	
		return wp.element.createElement(
			'div',
			{ className: 'notice-box notice-' + props.attributes.type },
			wp.element.createElement(
				'div',
				{ className: 'notice-content' },
				props.attributes.imagePosition === 'left' && wp.element.createElement(
					'div',
					{ className: 'image-left' },
					wp.element.createElement(wp.editor.MediaUpload, {
						onSelect: onSelectImage,
						allowedTypes: 'image',
						value: props.attributes.imageUrl,
						render: function render(obj) {
							return [wp.element.createElement(wp.components.Button, {
								className: 'components-button button button-large',
								onClick: obj.open
							}, 'Select Image'), props.attributes.imageUrl && wp.element.createElement('img', { src: props.attributes.imageUrl, alt: 'Preview Image', style: { maxWidth: '100%', marginTop: '10px' } })];
						}
					})
				),
				props.attributes.imagePosition === 'right' && wp.element.createElement(
					'div',
					{ className: 'image-right' },
					wp.element.createElement(wp.editor.MediaUpload, {
						onSelect: onSelectImage,
						allowedTypes: 'image',
						value: props.attributes.imageUrl,
						render: function render(obj) {
							return [wp.element.createElement(wp.components.Button, {
								className: 'components-button button button-large',
								onClick: obj.open
							}, 'Select Image'), props.attributes.imageUrl && wp.element.createElement('img', { src: props.attributes.imageUrl, alt: 'Preview Image', style: { maxWidth: '100%', marginTop: '10px' } })];
						}
					})
				),
				
			wp.element.createElement('select', {
				onChange: function onChange(event) {
					updateImagePosition(event.target.value);
				},
				value: props.attributes.imagePosition,
				style: { width: '100%', marginTop:"10px",marginBottom:"15px" }
			}, wp.element.createElement("option", { value: "left" }, "Image Left"), wp.element.createElement("option", { value: "right" }, "Image Right")),

				wp.element.createElement(
					'div',
					{ className: 'text-' },
					wp.element.createElement('input', {
						type: 'text',
						placeholder: 'Write your heading here...',
						value: props.attributes.title,
						onChange: updateTitle,
						style: { width: '100%' }
					}),
					wp.element.createElement(wp.editor.RichText, {
						tagName: 'p',
						onChange: updateContent,
						value: props.attributes.content,
						placeholder: 'Write your description here...'
					}),
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
					
				)
			)
		);
	},
	save: function(props) {
		var imageCol, contentCol;
		
		if (props.attributes.imagePosition === 'left') {
			imageCol = el( 'div', { className: 'col-md-12 col-lg-6' },
				el( 'div', { className: 'leftImg img' },
					el( 'div', { className: 'leftImg_style' },
						el( 'img', { src: props.attributes.imageUrl, alt: 'about-img1', className: 'img-fluid' } )
					)
				)
			);

			contentCol = el( 'div', { className: 'col-md-12 col-lg-6' },
				el( 'div', { className: 'leftImg content lg-pl-34 home-content-wrap' },
					el( 'div', { className: 'text_content heading position-relative ' },
						el( 'h2', null, props.attributes.title ),
						el( wp.editor.RichText.Content, { tagName: 'p', value: props.attributes.content } ),
					),
					
					props.attributes.buttonUrl ? el('a', { href: props.attributes.buttonUrl,  className: 'btn custom-btn' },props.attributes.buttonText?props.attributes.buttonText:'Kontakt os') : ''
				),
				
			);
		} else {
			imageCol = el( 'div', { className: 'col-md-12 col-lg-6' },
				el( 'div', { className: 'leftImg img' },
					el( 'div', { className: 'leftImg_style' },
						el( 'img', { src: props.attributes.imageUrl, alt: 'about-img1', className: 'img-fluid' } )
					)
				)
			);
			contentCol = el( 'div', { className: 'col-md-12 col-lg-6' },
				el( 'div', { className: 'leftImg content home-content-wrap' },
					el( 'div', { className: 'text_content heading position-relative ' },
						el( 'h2', null, props.attributes.title ),
						el( wp.editor.RichText.Content, { tagName: 'p', value: props.attributes.content } ),
					),
					
					props.attributes.buttonUrl ? el('a', { href: props.attributes.buttonUrl,  className: 'btn custom-btn' },props.attributes.buttonText?props.attributes.buttonText:'Kontakt os') : ''
				),
				
			);
			/*contentCol = el( 'div', { className: 'col-md-12 col-lg-6' },
				el( 'div', { className: 'content-left ml-128' },
					el( 'div', { className: 'content' },
						el( 'h2', null, props.attributes.title ),
						el( wp.editor.RichText.Content, { tagName: 'p', value: props.attributes.content } ),
					),
					props.attributes.buttonUrl ? el('a', { href: props.attributes.buttonUrl,  className: 'btn custom-btn' },props.attributes.buttonText?props.attributes.buttonText:'Kontakt os') : ''
				),
			);*/
		}

		return el( 'section', { className: props.attributes.imagePosition === 'left' ? 'leftImg':'leftImg right-img' },			
			el( 'div', { className: 'row' },
				props.attributes.imagePosition === 'left' ? [imageCol, contentCol] : [contentCol,imageCol ]
			)
			
		);
	}
});