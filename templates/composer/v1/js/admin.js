class PluginName extends PluginNameCommon {

    static run() {
        super.run();
        console.log('Admin runner');
    }

}

window.addEventListener("load", (event) => {
    PluginName.run();
});
