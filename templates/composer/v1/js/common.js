class PluginNameCommon {

    static JS_DEBUG = true;

    static run() {
        this.log('Common runner');
    }

    static log(message) {
        if(this.JS_DEBUG) console.log(message);
    }

}
