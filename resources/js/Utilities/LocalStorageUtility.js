import { CryptoUtility } from "./CryptoUtility";

export class LocalStorageUtility {
    static get(key) {
        var output = localStorage.getItem(key);
        if (output) {
            return CryptoUtility.decrypt(output);
        }

        return undefined;
    }

    static set(key, value) {
        localStorage.setItem(key, CryptoUtility.encrypt(value));
    }

    static delete(key, value) {
        localStorage.removeItem(key);
    }
}
