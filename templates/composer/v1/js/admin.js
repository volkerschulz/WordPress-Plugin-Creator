class PluginName extends PluginNameCommon {

    static run() {
        super.run();
        this.log('Admin runner');
    }

}

window.addEventListener("load", (event) => {
    PluginName.run();
});
