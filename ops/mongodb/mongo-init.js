db.createUser(
    {
        user: "mpw_user",
        pwd: "example",
        roles: [
            {
                role: "readWrite",
                db: "mpw"
            }
        ]
    }
);

db.events.insertOne({
    name: 'Example',
    email: 'example@test.com',
    date: '2021-01-01',
    type: 'birthday',
    details: "This is a test",
    newsletter: true,
})