<template>
    <div class="menu-body">
        <div class="tile-area">
            <div class="single-tile-group">
                <div data-role="tile" href="#" @click="moveModul('/hris')" class="tile-large bunder">
                    <div class="tile-content iconic">
                        <span :class="[animation ? icon.hris : icon2.hris]"></span>
                    </div>
                    <span class="tile-label">HRIS</span>
                </div>
                <div data-role="tile" class="tile tile-square-x bunder" @click="url('/fleet-management')">
                    <div class="tile-content iconic">
                        <span :class="[animation ? icon.fleet : icon2.fleet]" id="mif-organization"></span>
                    </div>
                    <span class="tile-label">Fleet Management</span>
                </div>
                <div data-role="tile" class="tile tile-square-x bunder" @click="url('/help-desk')">
                    <div class="tile-content iconic">
                        <span :class="[animation ? icon.help_desk : icon2.help_desk]" id="mif-organization"></span>
                    </div>
                    <span class="tile-label">Help Desk</span>
                </div>
            </div>
            <div class="single-tile-group">
                <div data-role="tile" class="tile-wide bunder" @click="url('/marketing-idea')">
                    <div class="tile-content iconic">
                        <span :class="[animation ? icon.marketing_idea : icon2.marketing_idea]" id="mif-truck mif-ani-pass"></span>
                    </div>
                    <span class="tile-label">Marketing Idea</span>
                </div>
                <div data-role="tile" class="tile bunder">
                    <div class="tile-content iconic">
                        <span :class="[animation ? icon.finance : icon2.finance]" id="mif-user"></span>
                    </div>
                    <span class="tile-label">Finance</span>
                </div>
                <div data-role="tile" class="tile bunder">
                    <div class="tile-content iconic">
                        <span :class="[animation ? icon.purchasing : icon2.purchasing]" id="mif-user"></span>
                    </div>
                    <span class="tile-label">Purchasing</span>
                </div>
                <div data-role="tile" class="tile-wide bunder">
                    <div class="tile-content iconic" >
                        <span :class="[animation ? icon.other : icon2.other]" id="mif-bell"></span>
                    </div>
                    <span class="tile-label">Other</span>
                </div>
            </div>
            <div class="single-tile-group">
                <div data-role="tile" class="tile bunder">
                    <div class="tile-content iconic" >
                        <span :class="[animation ? icon.inventory : icon2.inventory]" id="mif-steps"></span>
                    </div>
                    <span class="tile-label">Inventory Control</span>
                </div>
                <div data-role="tile" v-on:click="moveModul('/warehouse')" class="tile bunder">
                    <div class="tile-content iconic" >
                        <span :class="[animation ? icon.warehouse : icon2.warehouse]" id="mif-user-plus"></span>
                    </div>
                    <span class="tile-label">Warehouse</span>
                </div>
                <div data-role="tile" class="tile-large bunder">
                    <div class="tile-content iconic" >
                        <span :class="[animation ? icon.other : icon2.other]" id="mif-hammer"></span>
                    </div>
                    <span class="tile-label">Other</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                colors : ['lime', 'green', 'emerald', 'teal', 'blue', 'cyan', 'cobalt', 'indigo', 'violet', 'pink', 'magenta', 'crimson', 'red', 'orange', 'amber', 'yellow', 'brown', 'olive', 'steel', 'mauve', 'taupe', 'darkBrown', 'darkCrimson', 'darkMagenta', 'darkIndigo', 'darkCyan', 'darkCobalt', 'darkTeal', 'darkEmerald', 'darkGreen', 'darkOrange', 'darkRed', 'darkPink', 'darkViolet', 'darkBlue', 'lightBlue', 'lightRed', 'lightGreen', 'lighterBlue', 'lightOlive', 'lightPink'],
                icon : {
                    hris : 'icon mif-user mif-ani-flash',
                    fleet : 'icon fa fa-taxi mif-ani-heartbeat',
                    help_desk : 'icon mif-phone mif-ani-heartbeat',
                    marketing_idea : 'icon mif-chart-line mif-ani-heartbeat',
                    finance : 'icon mif-visa mif-ani-shuttle',
                    purchasing : 'icon mif-unlock mif-ani-flash',
                    other : 'icon mif-sun mif-ani-ring mif-ani-slow',
                    inventory : 'icon mif-search mif-ani-vertical',
                    warehouse : 'icon mif-library mif-ani-float',
                    other : 'icon mif-sun mif-ani-spanner',
                },
                icon2 : {
                    hris : 'icon mif-user',
                    fleet : 'icon fa fa-taxi',
                    help_desk : 'icon mif-phone',
                    marketing_idea : 'icon mif-chart-line',
                    finance : 'icon mif-visa',
                    purchasing : 'icon mif-unlock',
                    other : 'icon mif-sun',
                    inventory : 'icon mif-search',
                    warehouse : 'icon mif-library',
                    other : 'icon mif-sun',
                },
                animation : false,
            }
        },
        methods :{
            getRC : function(){
                return _.sample(this.colors)
            },
            url(uri){
                window.location = base_url(uri)
            },
            moveModul : function(modul){
                window.location = base_url(modul)
            },
            getAnimationSetting(){
                myApi('setting/animation-icon').then(res=>{
                    this.animation = res.data == 1
                }).catch(err=>{

                })
            }
        },
        created(){
            this.getAnimationSetting()
        },
        mounted(){
            let t = this;
            $('[data-role="tile"]').each(function(){
                var tile = $(this);
                tile.addClass('bg-'+t.getRC()+' fg-white');
            });
        }
    }
</script>
<style>
.bunder {
    border-radius: 20px;
}
</style>
