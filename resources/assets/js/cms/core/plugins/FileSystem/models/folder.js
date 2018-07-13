import Model from '../../../models/Model';
import Validator from '../../../../app/Validator/Validator';



class Folder extends Model {

    constructor(data = {}) {
        super(data);
    }

    dossiers() {
        return Dossier.where([
            ['folder_id', '=' , this.id],
        ]);
    }

    static rootDossiers() {
        return Dossier.where([
            ['folder_id', '=' , 'NULL'],
        ]);
    }

    parent(folders) {
        let parent = _.find(folders, (folder) => {
            return this.parent_id === folder.id;
        });

        return parent;
    }

    children() {
        return Folder.where([
            ['parent_id', '=', this.id]
        ]);
    }

    static rootFolders() {
        return Folder.where([
            ['parent_id', '=', "NULL"]
        ]);      
    }

    hasParent() {
        return this.parent_id !== null;
    }

}

export default Folder;