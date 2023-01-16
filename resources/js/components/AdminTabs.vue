<template>
    <ul class="flex flex-wrap -mb-px justify-center">
        <li class="mr-2" v-for="tab in dataTabs">
            <a :href="origin + tab.url" class="inline-block p-4 rounded-t-lg border-b-2" :class="tabClasses(tab)"
                aria-current="page">

                {{ tab.tab }}
            </a>
        </li>
    </ul>
</template>

<script>

export default {
    mounted() {
        this.origin = window.origin;
    },
    methods: {
        tabClasses(tab) {
            let classes = '';
            const pathname = window.location.pathname;
            if (tab.subRoute) {
                const route = tab.subRoute.find((route) => {
                    if (route.toLowerCase() == this.currentRoute.toLowerCase() ) {
                        return route;
                    }
                });
                if(route) {
                    classes = 'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500';
                    return classes;
                }
            }
            classes = tab.url.toLowerCase() == pathname.toLowerCase() ? 'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'
            return classes;
        }
    },
    data() {
        return {
            dataTabs: [
                { tab: 'Courts', url: '/admin/courts' , subRoute: ['courts.create', 'courts.edit'] },
                { tab: 'Track Book', url: '/admin' },
                { tab: 'List Book', url: '/admin/sandbox' },
            ],
            origin: '',
        }
    },
    props: {
        currentRoute: {
            type: String,
            default: '',
        },
    },
}
</script>
