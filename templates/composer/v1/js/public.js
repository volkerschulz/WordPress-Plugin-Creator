class PluginName extends PluginNameCommon {

    static run() {
        super.run();
        console.log('Public runner');
    }

}

window.addEventListener("load", (event) => {
    PluginName.run();
});
