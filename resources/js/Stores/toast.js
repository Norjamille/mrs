import { reactive } from "vue";

export default reactive({
    items: [],
    add(toast) {
        this.items.unshift({
            key: Symbol(),
            ...toast
        });
    },
    remove(index) {
        this.items.splice(index, 1);
    },
    generateUniqueKey() {
        var key = Math.random().toString(36).slice(2, 15);
        return key;
    }
});