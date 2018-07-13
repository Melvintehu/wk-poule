import Model from './Model';
import Validator from '../../app/Validator/Validator';
import WalkThrough from '../../app/WalkThrough/WalkThrough';

class User extends Model {

    constructor(data = {}) {
        super(data);

        this.relations['userRole'] = function() {
            return this.belongsToMany('userRole');
        }

        this.fields = {
            name: {
                type: 'text',
                translation: 'Naam',
                validation: new Validator({
                    required: true,
                }),
            },

            email: {
                type: 'text',
                translation: 'Email',
                validation: new Validator({
                    required: true
                }),
            }, 

            password: {
                type: 'text',
                translation: 'Wachtwoord',
                validation: new Validator({
                    required: true
                }),

                hidden: ['read', 'update'],
            }, 

            phone_number: { 
				type: 'text', 
				translation: 'Telefoonnummer',
				validation: new Validator({
					required: true
				})  
            },
            
            role_id: { 
				type: 'model-checkbox',
                model: 'role',
                selected: this.rolesForUser(),
				referenceField: 'name',
				translation: 'Rolnaam', 
				validation: new Validator({
					required: true
                }),
                hidden: ['read', 'create'],
			},

            photo: {
                type: 'photo',
                translation: 'Kies een foto',
                dimensions: {"1x1": 'portrait'},
                validation: new Validator({
                    required: true
                }),
                hidden: ['read'],
            },
        };

    }

    static roles() {
        return UserRole.all();
    }

    rolesForUser() {

        if(this.id !== undefined) {
            return new Promise((resolve, reject) => {
                API.get('test/roles?id=' + this.id, ).then((roles) => {
                    resolve(roles);
                });
            });
        }
    }

    static hasRoles(userRoles, allowedRoles) {
        for(let index in userRoles) {
            let role = userRoles[index];

            if(_.indexOf(allowedRoles, role.name) !== -1) {
                return true;
            }
        }
    }

    static isA(allowedRoles) {
        return new Promise((resolve, reject) => {
            User.roles().then((userRoles) => {
                resolve(User.hasRoles(userRoles, allowedRoles));                
            });
        });
    }
    

}

export default User;