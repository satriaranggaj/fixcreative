import { lightTheme, darkTheme } from "naive-ui";
import { SecurityUtility } from "@/Utilities/SecurityUtility";
import { LocalStorageUtility } from "@/Utilities/LocalStorageUtility";
import { reactive } from "vue";
import * as appConfig from "@/theme.js";


const state = reactive({
    theme: lightTheme,
    loadingStack: 0,
    themeOverrides: {
        common: {
            fontFamily: "'Plus Jakarta Sans', sans-serif",
            borderRadius: '10px',
            primaryColor: appConfig.theme.primary['500'],
            primaryColorHover: appConfig.theme.primary['600'],
            primaryColorPressed: appConfig.theme.primary['600'],
            primaryColorSuppl: appConfig.theme.primary['600'],

        },
    },
    increaseLoadingStack() {
        this.loadingStack++;
    },
    decreaseLoadingStack() {
        this.loadingStack--;
    },
    setTheme(newTheme) {
        LocalStorageUtility.set(
            SecurityUtility.encryptedLocalStorageKeys.theme,
            newTheme.name == "dark" ? "dark" : "light"
        )

        this.theme = newTheme;
    },

    setup() {
        var _theme = LocalStorageUtility.get(SecurityUtility.encryptedLocalStorageKeys.theme);

        if (typeof _theme === "string") {
            this.theme = _theme == "dark" ? darkTheme : lightTheme;
        }
    },

    destroy() {
        LocalStorageUtility.delete(SecurityUtility.encryptedLocalStorageKeys.theme);
    }
})



export default state;

