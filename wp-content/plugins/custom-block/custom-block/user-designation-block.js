"use client"
var el = wp.element.createElement;
var Button = wp.components.Button;
wp.blocks.registerBlockType('gutenberg-notice-block/user-designation-block', {
    
    title: 'User Designation Block',
    icon: 'admin-users',
    category: 'common',
    attributes: {
        title: { type: 'string' },
        users: { type: 'array', default: [] }
    },
    edit: function(props) {
        // Ensure user data is fetched
        // let [userData, setUserData] = wp.element.useState([]);
        // // var userData2 = wp.data.select('core').getEntityRecords('root', 'user')|| [];
        
        // wp.element.useEffect(() => {

        //     const fetchAllUsers = async () => {
        //         try {
        //             // Fetch all users from the WordPress REST API
        //             const allUsers = await wp.apiFetch({ path: '/wp/v2/users' });
        //             console.log('All users:', allUsers);
        //             setUserData(allUsers)
        //             // Now you can use the fetched user data as needed
        //         } catch (error) {
        //             console.error('Error fetching all users:', error);
        //         }
        //     };
        
        //     // Call fetchAllUsers when the component mounts
        //     fetchAllUsers();
        // }, [props.attributes.users]); // Re-fetch user data when user list is updated
    
        // // Function to handle updating title
        // function updateTitle(event) {
        //     props.setAttributes({ title: event.target.value });
        // }
    
        // // Function to handle adding a new user
        // function addUser() {
        //     var updatedUsers = [...props.attributes.users, { userId: '', designation: '' }];
        //     props.setAttributes({ users: updatedUsers });
        // }
    
        // // Function to handle updating user ID
        // function updateUser(userId, index) {
        //     var updatedUsers = [...props.attributes.users];
        //     updatedUsers[index].userId = userId;
        //     props.setAttributes({ users: updatedUsers });
        // }
    
        // // Function to handle updating designation
        // function updateDesignation(designation, index) {
        //     var updatedUsers = [...props.attributes.users];
        //     updatedUsers[index].designation = designation;
        //     props.setAttributes({ users: updatedUsers });
        // }
    
        // // Function to handle removing a user
        // function removeUser(index) {
        //     var updatedUsers = [...props.attributes.users];
        //     updatedUsers.splice(index, 1);
        //     props.setAttributes({ users: updatedUsers });
        // }
    
        // // Map users to input fields
        // var userFields = props.attributes.users.map(function(user, index) {
        //     return wp.element.createElement('div', { key: index },
        //         wp.element.createElement('select', {
        //             value: user.userId,
        //             onChange: function(event) { updateUser(event.target.value, index); },
        //             className: 'user-dropdown',
        //         }, userData.map(function(user) {
        //             return wp.element.createElement('option', { key: user.id, value: user.id }, user.name);
        //         })),
        //         wp.element.createElement('input', {
        //             type: 'text',
        //             value: user.designation,
        //             onChange: function(event) { updateDesignation(event.target.value, index); },
        //             placeholder: 'Enter designation...',
        //             className: 'designation-field'
        //         }),
        //         wp.element.createElement(Button, {
        //             isDestructive: true,
        //             onClick: function() { removeUser(index); }
        //         }, 'Remove')
        //     );
        // });
    
        // return wp.element.createElement('div', null,
        //     wp.element.createElement(Button, { onClick: addUser }, 'Add User'),
        //     wp.element.createElement('input', {
        //         type: 'text',
        //         placeholder: 'Write your title here...',
        //         value: props.attributes.title,
        //         onChange: updateTitle,
        //         style: { width: '100%' }
        //     }),
        //     userFields
        // );
    },
    save: function(props) {
        const { createElement: el,  } = wp.element;
        const [userRecordsArray, setUserRecords] = wp.element.useState([]);
    
        // Fetch user records
        wp.element.useEffect(() => {
            const fetchUserRecords = async () => {
                const records = [];
                for (const user of props.attributes.users) {
                    try {
                        const userRecord = await wp.apiFetch({ path: '/wp/v2/users/' + user.userId });
                        records.push(userRecord);
                    } catch (error) {
                        console.error('Error fetching user:', error);
                    }
                }
                setUserRecords(records);
            };
            fetchUserRecords();
            console.log("userRecordsArray", userRecordsArray)
        }, []);
    
        return( el('section', { className: 'module-supporters' },
            el('div', { className: 'container-fluid' },
                el('div', { className: 'row' },
                    el('div', { className: 'col-lg-12' },
                        el('div', { className: 'content-left' },
                            el('h2', null, props.attributes.title)
                        )
                    ),
                    // userRecordsArray.map((user, index)=> {
                    //     console.log("USER", user)
                    //     return el('div', { className: 'col-xl-3 col-lg-4 col-md-6', key: index },
                    //         el('div', { className: 'supporters' },
                    //             el('div', { className: 'img-wrap' },
                    //                 user && user.avatar_urls && el('img', { src: user.avatar_urls['96'], alt: user.name })
                    //             ),
                    //             el('div', { className: 'user-info' },
                    //                 user && user.name && el('p', { className: 'fw-bold' }, user.name),
                    //                 el('p', null, props.attributes.users[index].designation)
                    //             )
                    //         )
                    //     );
                    // })
                )
            )
        ))
    }
    
});