import Plugin from '../Plugin';

class FileSystem extends Plugin {

    boot() {
        this.name = "Cloud Drive";
        this.entry = 'index';
        this.entryComponent = 'file-system';
        this.icon = "cloud_upload";
        this.allowedRoles = [
            'admin', 
            'mentor', 
            'sitemanager',
        ];
    }
    

}

export default FileSystem;