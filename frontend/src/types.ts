export type Event = {
    id?: string,
    name: '',
    email: '',
    date: '',
    type: EventType | null,
    details: '',
    newsletter: false,
};

export type EventType = 'wedding' | 'birthday' | 'corporate' | 'other';