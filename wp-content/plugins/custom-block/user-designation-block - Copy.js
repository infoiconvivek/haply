var el = wp.element.createElement;
var Button = wp.components.Button;

wp.blocks.registerBlockType('gutenberg-notice-block/user-designation-block', {
    title: 'User Designation Block',
    icon: 'admin-users',
    category: 'common',
	supports: {},
    attributes: {
        title: { type: 'string' },
        users: { type: 'array', default: [] }
    },
    edit: function(props) {
        // Function to handle updating title
        function updateTitle(event) {
            props.setAttributes({ title: event.target.value });
        }

        // Function to handle adding a new user
        function addUser() {
            var updatedUsers = [...props.attributes.users, { userId: '', designation: '' }];
            props.setAttributes({ users: updatedUsers });
        }

        // Function to handle updating user ID
        function updateUser(userId, index) {
            var updatedUsers = [...props.attributes.users];
            updatedUsers[index].userId = userId;
            props.setAttributes({ users: updatedUsers });
        }

        // Function to handle updating designation
        function updateDesignation(designation, index) {
            var updatedUsers = [...props.attributes.users];
            updatedUsers[index].designation = designation;
            props.setAttributes({ users: updatedUsers });
        }

        // Function to handle removing a user
        function removeUser(index) {
            var updatedUsers = [...props.attributes.users];
            updatedUsers.splice(index, 1);
            props.setAttributes({ users: updatedUsers });
        }

        // Fetch user data
        var userData = wp.data.select('core').getEntityRecords('root', 'user') || [];

        // Map users to input fields
        var userFields = props.attributes.users.map(function(user, index) {
            return el('div', { key: index },
                el('select', {
                    value: user.userId,
                    onChange: function(event) { updateUser(event.target.value, index); },
                    className: 'user-dropdown',
                }, userData.map(function(user) {
                    return el('option', { key: user.id, value: user.id }, user.name);
                })),
                el('input', {
                    type: 'text',
                    value: user.designation,
                    onChange: function(event) { updateDesignation(event.target.value, index); },
                    placeholder: 'Enter designation...',
                    className: 'designation-field'
                }),
                el(Button, {
                    isDestructive: true,
                    onClick: function() { removeUser(index); }
                }, 'Remove')
            );
        });

        return el('div', null,
            el(Button, { onClick: addUser }, 'Add User'),
            el('input', {
                type: 'text',
                placeholder: 'Write your title here...',
                value: props.attributes.title,
                onChange: updateTitle,
                style: { width: '100%' }
            }),
            userFields
        );
    },
    save: function(props) {
        return el('section', { className: 'module-supporters' },
            el('div', { className: 'container-fluid' },
                el('div', { className: 'row' },
                    el('div', { className: 'col-lg-12' },
                        el('div', { className: 'content-left' },
                            el('h2', null, props.attributes.title)
                        )
                    ),
                    props.attributes.users.map(function(user, index) {
                        var userRecord = wp.data.select('core').getEntityRecord('root', 'user', user.userId);
                        return el('div', { className: 'col-xl-3 col-lg-4 col-md-6', key: index },
                            el('div', { className: 'supporters' },
                                el('div', { className: 'img-wrap' },
                                    userRecord && el('img', { src: userRecord.avatar_urls['96'], alt: userRecord.name })
                                ),
                                el('div', { className: 'user-info' },
                                    userRecord && el('p', { className: 'fw-bold' }, userRecord.name),
                                    el('p', null, user.designation)
                                )
                            )
                        );
                    })
                )
            )
        );
    }
});