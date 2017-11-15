export default {
    guid(){
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8)
            return v.toString(16);
        })
    },
    mobile(){
        return /Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)
    },
    toTreeData(data, parent,parentid=0){
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
    }
}