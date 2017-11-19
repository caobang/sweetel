export default {
    guid(){
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8)
            return v.toString(16);
        })
    },
    isMobile(){
        return /Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)
    },
    /*toTreeData(data, parent,parentid=0){
        var tree = [];
        var temp;
        for (var i = 0; i < data.length; i++) {
            if (data[i][parent] == parentid) {
                var obj = data[i];
                temp = this.toTreeData(data, parent,data[i].id);
                if (temp.length > 0) {
                    obj.children = temp;
                }
                tree.push(obj);
            }
        }
        return tree;
    },
    getParentKeys(data, parent,id){
        for (var i = 0; i < data.length; i++) {
            if (data[i].id == id) {
                return this.getParentKeys(data,parent,data[i][parent]).concat(id)
            }
        }
        return [];
    }*/

    getCurrentScriptUrl(){
        let scripts = document.getElementsByTagName('script'); 
        let currentScript = scripts[scripts.length - 1];
        let src = currentScript.getAttribute('src')
        return src
    },
    getBaseUrl(url){
        let httpPos = url.indexOf("//")
        let absPos=httpPos>-1?url.indexOf('/',httpPos+2):url.indexOf('/')
        let baseUrl=absPos>-1?url.substring(0,absPos+1):'/'
        return baseUrl
    },
    getUrlParams(url){
        let httpPos = url.indexOf("//")
        let absPos=httpPos>-1?url.indexOf('/',httpPos+2):url.indexOf('/')
        let baseUrl=absPos>-1?url.substring(0,absPos+1):'/'
        let paramsPos = url.indexOf('?')
        let params=paramsPos>-1?url.substring(paramsPos+1):''
        return params
    },
    loadScript(url,callback){
        let head = document.getElementsByTagName('head')[0];
        let script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = url;
        script.onload = script.onreadystatechange = function() {
            if ((!this.readyState || this.readyState === 'loaded' || this.readyState === 'complete')) {
                callback&&callback()
                script.onload = script.onreadystatechange = null;
                if (head && script.parentNode) {
                    head.removeChild(script);
                }
            }
        };
        head.insertBefore(script, head.firstChild);
    }
}