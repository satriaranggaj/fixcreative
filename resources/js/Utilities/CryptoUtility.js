import CryptoJS from "crypto-js";
import { SecurityUtility } from "./SecurityUtility";

export class CryptoUtility {
    static encrypt(data) {
        return CryptoJS.AES.encrypt(
            data.toString(),
            SecurityUtility.cryptoPassword
        ).toString();
    }

    static decrypt(data) {
        try {
            return CryptoJS.AES.decrypt(
                data,
                SecurityUtility.cryptoPassword
            )?.toString(CryptoJS.enc.Utf8);
        } catch (error) {
            return undefined;
        }
    }
}
