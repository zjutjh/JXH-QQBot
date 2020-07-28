import IResponse from "../interface/IResponse";

const serverUrl = "http://47.103.1.116:8080";

enum apiMap {
    systemInfo = "/index/info",
    getDictionary = "/dic/get",
    updateDictionary = "/dic/update",
    addDictionary = "/dic/add",
    delDictionary = "/dic/delete",

    getBan = "/ban/get",
    updateBan = "/ban/update",
    addBan = "/ban/add",
    delBan = "/ban/delete",

    login = "/auth/login",
    logout = "/auth/logout",

}

/**
 *
 * 用Post发送JSON请求
 * @param {string} url
 * @param {*} data
 * @returns {Promise<IResponse>}
 */
async function postData(url: string, data: any = null): Promise<IResponse> {
    // Default options are marked with *
    const response = await fetch(url, {
        body: JSON.stringify(data),
        cache: "no-cache",
        credentials: "include",
        headers: {
            "content-type": "application/json",
        },
        method: "POST",
        mode: "cors",
        redirect: "follow",
        referrer: "no-referrer",
    });
    return await response.json(); // parses response to JSON
}

/**
 * get API url by API name
 * @return {string}
 */
function FetchAPI(name: apiMap, data: object = {}): Promise<IResponse> {
    return postData(`${serverUrl}${name}`, data);
}

export {FetchAPI, apiMap};