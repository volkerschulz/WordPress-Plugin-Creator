class PluginName extends PluginNameCommon {

    static run() {
        super.run();
        this.log('Public runner');
    }

}

window.addEventListener("load", (event) => {
    PluginName.run();
});
