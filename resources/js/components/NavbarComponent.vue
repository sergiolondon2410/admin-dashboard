<template> 
    <div id="app">
        <v-app id="inspire">
            <v-card
            class="mx-auto"
            height="400"
            width="256"
            >
                <v-navigation-drawer
                    class="accent-4"
                    dark
                    permanent
                >
                    <v-list>
                        <v-list-item
                            v-for="item in items"
                            :key="item.title"
                            link
                        >
                            <v-list-item-icon>
                                <v-icon>{{ item.icon }}</v-icon>
                            </v-list-item-icon>
                
                            <v-list-item-content>
                                <v-list-item-title>{{ item.title }}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                </v-navigation-drawer>
            </v-card>
    </v-app>
    </div>
</template>

<script>
    new Vue({
        el: '#app',
        vuetify: new Vuetify(),
        data () {
            return {
            items: [
                { title: 'Dashboard', icon: 'dashboard' },
                { title: 'Account', icon: 'account_box' },
                { title: 'Admin', icon: 'gavel' },
            ],
            }
        },
    })
</script>   