const { createElement, useState, useEffect } = wp.element;
const { Button } = wp.components;
const { registerBlockType } = wp.blocks;

registerBlockType('gutenberg-notice-block/user-designation-block', {
    title: 'User Designation Block',
    icon: 'admin-users',
    category: 'common',
    supports: {},
    attributes: {
        title: { type: 'string' },
        users: { type: 'array', default: [] }
    },
    edit: function (props) {
        const [userData, setUserData] = useState([]);

        useEffect(() => {
            async function fetchUserData() {
                try {
                    const data = await wp.data.select('core').getEntityRecords('root', 'user');
                    setUserData(data || []);
                } catch (error) {
                    console.error('Error fetching user data:', error);
                    setUserData([]); // Handle error by setting userData to an empty array
                }
            }
            fetchUserData();
        }, []);

        // Use a useEffect hook to update userData when props.attributes.users change
        useEffect(() => {
            // Fetch updated user data when users list changes
            async function fetchUpdatedUserData() {
                try {
                    const data = await wp.data.select('core').getEntityRecords('root', 'user');
                    setUserData(data || []);
                } catch (error) {
                    console.error('Error fetching updated user data:', error);
                    // Handle error if needed
                }
            }

            // Call the function to fetch updated user data
            fetchUpdatedUserData();
        }, [props.attributes.users]); // Run this effect when props.attributes.users change


        function updateTitle(event) {
            props.setAttributes({ title: event.target.value });
        }

        function addUser() {
            const updatedUsers = [...props.attributes.users, { userId: '', designation: '' }];
            props.setAttributes({ users: updatedUsers });
        }

        function updateUser(userId, index) {
            const updatedUsers = [...props.attributes.users];
            updatedUsers[index].userId = userId;
            props.setAttributes({ users: updatedUsers });
        }

        function updateDesignation(designation, index) {
            const updatedUsers = [...props.attributes.users];
            updatedUsers[index].designation = designation;
            props.setAttributes({ users: updatedUsers });
        }

        function removeUser(index) {
            const updatedUsers = [...props.attributes.users];
            updatedUsers.splice(index, 1);
            props.setAttributes({ users: updatedUsers });
        }

        const userFields = userData.length > 0 && props.attributes.users.map((user, index) => {
            return createElement('div', { key: index },
                createElement('select', {
                    value: user.userId,
                    onChange: (event) => updateUser(event.target.value, index),
                    className: 'user-dropdown',
                }, userData.map((user) => {
                    return createElement('option', { key: user.id, value: user.id }, user.name);
                })),
                createElement('input', {
                    type: 'text',
                    value: user.designation,
                    onChange: (event) => updateDesignation(event.target.value, index),
                    placeholder: 'Enter designation...',
                    className: 'designation-field'
                }),
                createElement(Button, {
                    isDestructive: true,
                    onClick: () => removeUser(index)
                }, 'Remove')
            );
        });

        return createElement('div', null,
            createElement(Button, { onClick: addUser }, 'Add User'),
            createElement('input', {
                type: 'text',
                placeholder: 'Write your title here...',
                value: props.attributes.title,
                onChange: updateTitle,
                style: { width: '100%' }
            }),
            userFields
        );
    },
    save: function (props) {
        return createElement('section', { className: 'module-supporters' },
            createElement('div', { className: 'container-fluid' },
                createElement('div', { className: 'row' },
                    createElement('div', { className: 'col-lg-12' },
                        createElement('div', { className: 'content-left' },
                            createElement('h2', null, props.attributes.title)
                        )
                    ),
                    props.attributes.users.map((user, index) => {
                        const userRecord = wp.data.select('core').getEntityRecord('root', 'user', user.userId);
                        return createElement('div', { className: 'col-xl-3 col-lg-4 col-md-6', key: index },
                            createElement('div', { className: 'supporters' },
                                createElement('div', { className: 'img-wrap' },
                                    userRecord && createElement('img', { src: userRecord.avatar_urls['96'], alt: userRecord.name })
                                ),
                                createElement('div', { className: 'user-info' },
                                    userRecord && createElement('p', { className: 'fw-bold' }, userRecord.name),
                                    createElement('p', null, user.designation)
                                )
                            )
                        );
                    })
                )
            )
        );
    }
});