    /*
    |--------------------------------------------------------------------------
    | Core models
    |--------------------------------------------------------------------------
    |
    | These models are accessable in the entire javascript cms system.
    | 
    | 
    |
    */

    import Entity from './Entity';
    import Section from './Section';
    import UserRole from './UserRole';
    import User from './User';
    import NavGroup from './NavGroup';
    import Settings from './Settings';
    import Role from './Role';
    

    let models = {
        entity: Entity,
        section: Section,
        userRole: UserRole,
        navGroup: NavGroup,
        user: User,
        settings: Settings,
        role: Role,
    }

    /*
    |--------------------------------------------------------------------------
    | Adding models to the window object
    |--------------------------------------------------------------------------
    |
    | The models are added to the window object so they are accessable everywhere.
    | 
    | 
    |
    */

    window.models = Object.assign(window.models, models);
    window.User = User;
    window.Role = Role;
    window.UserRole = UserRole;