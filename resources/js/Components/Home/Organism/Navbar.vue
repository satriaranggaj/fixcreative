<script setup>
    import { onMounted, onUnmounted, ref } from 'vue';
    import { Link } from '@inertiajs/vue3';

    // nav Scroll
    let lastScrollTop = 0;
    const navVisible = ref(true);

    // Fungsi menangani scroll
    const handleScroll = () => {
        const st = window.scrollY;
        if (st > lastScrollTop) {
            navVisible.value = false;
        } else {
            navVisible.value = true;
        }
        lastScrollTop = st <= 0 ? 0 : st;
    };
    onMounted(() => {
        window.addEventListener('scroll', handleScroll);
    });
    onUnmounted(() => {
        window.removeEventListener('scroll', handleScroll);
    });
    // nav Scroll

    // hamburger
    const isMenuActive = ref(false);

    function toggleMenu() {
        isMenuActive.value = !isMenuActive.value;
    }
    // hamburger

    const UrlLogo = "/img/logo/logo_fixcreative.webp";
</script>

<template>
    <nav 
        class="fixed bg-white w-full h-[75px] leading-[75px] top-0 left-0 z-50 transition-transform duration-300"
        :class="{'-translate-y-full': !navVisible, 'translate-y-0': navVisible}"
    >
        <div class="h-full w-full px-5 flex justify-between items-center m-auto overflow-hidden sm:px-16 lg:px-32">
            <div class="logo min-w-fit h-[50px] mx-5">
                <Link class="flex h-[100%] justify-center items-center" :href="route('home')">
                    <img :src="UrlLogo" class="h-[50%] sm:h-[75%]" alt="logo" loading="lazy">
                </Link>
            </div>
            <div class="nav-links w-fit hidden justify-center lg:flex">
                <Link class="nav-link" :class="{active: route().current('home')}" :href="route('home')">
                    <p class="text-black">
                        Beranda
                    </p>
                </Link>
                <Link class="nav-link" :class="{active: route().current('about')}" :href="route('about')">
                    <p class="text-black">
                        Tentang Kami
                    </p>
                </Link>
                <Link class="nav-link" :class="{active: route().current('division') || route().current('division.photograph') || route().current('division.agency') || route().current('division.studio')}" :href="route('division')">
                    <p class="text-black">
                        Divisi
                    </p>
                </Link>
                <Link class="nav-link" :class="{active: route().current('portfolio') || route().current('portfolio.show')}" :href="route('portfolio')">
                    <p class="text-black">
                        Portofolio
                    </p>
                </Link>
                <Link class="nav-link" :href="route('career') " :class="{active: route().current('career')}">
                    <p class="text-black">
                        Karir
                    </p>
                </Link>
                <Link class="nav-link" :href="route('article')" :class="{active: route().current('article') || route().current('article.show')}">
                    <p class="text-black">
                        Artikel
                    </p>
                </Link>
                <Link class="nav-link" :href="route('contact')" :class="{active: route().current('contact')} ">
                    <p class="text-black">
                        Hubungi Kami
                    </p>
                </Link>
            </div>
            <div class="hamburger min-w-fit relative block mr-5 lg:hidden">
                <input type="checkbox" id="checkbox" @click="toggleMenu()">
                <label for="checkbox" class="toggle">
                    <div class="bars" id="bar1"></div>
                    <div class="bars" id="bar2"></div>
                    <div class="bars" id="bar3"></div>
                </label>
            </div>
            <div class="responsive-nav absolute top-full right-0 bg-white max-w-[500px] w-full shadow-inner-shadow-sm lg:hidden" :class="{nonActive: !isMenuActive}">
                <div class="nav-links-responsive grid gap-1">
                    <Link class="nav-link" :class="{active: route().current('home')}" :href="route('home')">
                        <p class="text-black">
                            Beranda
                        </p>
                    </Link>
                    <Link class="nav-link" :class="{active: route().current('about')}" :href="route('about')">
                        <p class="text-black">
                            Tentang Kami
                        </p>
                    </Link>
                    <Link class="nav-link" :class="{active: route().current('division')}" :href="route('division')">
                        <p class="text-black">
                            Divisi
                        </p>
                    </Link>
                    <Link class="nav-link" :href="route('portfolio')" :class="{active: route().current('portfolio') || route().current('portfolio.show')}">
                        <p class="text-black">
                            Portofolio
                        </p>
                    </Link>
                    <Link class="nav-link" :href="route('career')" :class="{active: route().current('career')} ">
                        <p class="text-black">
                            Karir
                        </p>
                    </Link>
                    <Link class="nav-link" :href="route('article')" :class="{active: route().current('article') || route().current('article.show')}">
                        <p class="text-black">
                            Artikel
                        </p>
                    </Link>
                    <Link class="nav-link" :href="route('contact')" :class="{active: route().current('contact')}">
                        <p class="text-black">
                            Hubungi Kami
                        </p>
                    </Link>
                </div>
            </div>
        </div>
    </nav>
</template>

<style scoped lang="scss">
    $primaryColor : #000000;
    nav{
        transition: all .3s ease-in-out;
        p{
            font-size: calc(.8rem + .2vw);
        }
        .nav-links{
            .nav-link{
                position: relative;
                height: 75px;
                padding: 0 15px;
                width: auto;
                width: fit-content;
                margin: 0 5px;

                p{
                    left: 50%;
                    transition: .3s all;
                }

                &::before{
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 0;
                    height: 100%;
                    border-bottom: 5px $primaryColor solid;
                    transition: .3s all;
                }
            }
            .active{
                p{
                    color: $primaryColor;
                }
                &::before{
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    border-bottom: 5px $primaryColor solid;
                    transition: all .3s;
                }
            }
            .nav-link:hover{
                p{
                    color: $primaryColor;
                }
                &::before{
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    border-bottom: 5px $primaryColor solid;
                }
            }   
        }
        .hamburger{
            /* From Uiverse.io by vinodjangid07 */ 
            #checkbox {
            display: none;
            }

            .toggle {
                position: relative;
                width: 40px;
                height: 40px;
                cursor: pointer;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 5px;
                transition-duration: .5s;
            }

            .bars {
                width: 100%;
                height: 4px;
                background-color: $primaryColor;
                border-radius: 4px;
            }

            #bar2 {
                transition-duration: .8s;
            }

            #bar1,#bar3 {
                width: 70%;
            }

            #checkbox:checked + .toggle .bars {
                position: absolute;
                transition-duration: .5s;
            }

            #checkbox:checked + .toggle #bar2 {
                transform: scaleX(0);
                transition-duration: .5s;
            }

            #checkbox:checked + .toggle #bar1 {
                width: 100%;
                transform: rotate(45deg);
                transition-duration: .5s;
            }

            #checkbox:checked + .toggle #bar3 {
                width: 100%;
                transform: rotate(-45deg);
                transition-duration: .5s;
            }

            #checkbox:checked + .toggle {
                transition-duration: .5s;
                transform: rotate(180deg);
            }
        }
        .responsive-nav{
            animation: activeAnimation .3s ease-in-out forwards;

            .nav-links-responsive{
                border-bottom: rgba(128, 128, 128, 0.5) 1px solid;
                padding-bottom: 5px;
                
                .nav-link{
                    position: relative;
                    height: 50px;
                    line-height: 50px;
            
                    p{
                        margin: 0 25px;
                        transition: all .3s;
                    }
                    &::before{
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 0;
                        height: 0;
                        border-left: 5px $primaryColor solid;
                        transition: height .3s ease-in-out, width .3s ease-in-out .3s;
                    }
                }
                .active{
            
                    p{
                        font-weight: bold;
                    }
            
                    &::before{
                        content: '';
                        background-color: rgba(0, 0, 0, 0.2);
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        border-left: 5px $primaryColor solid;
                    }
                }
                .nav-link:hover{
                    p{
                        font-weight: bold;
                    }
            
                    &::before{
                        content: '';
                        background-color: rgba(0, 0, 0, 0.2);
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        border-left: 5px $primaryColor solid;
                    }
                } 
                .nav-link:focus{
                    p{
                        font-weight: bold;
                    }
            
                    &::before{
                        content: '';
                        background-color: rgba(0, 0, 0, 0.2);
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        border-left: 5px $primaryColor solid;
                    }
                }  
            }
        }
        .nonActive{
            animation: nonActiveAnimation .3s ease-in-out forwards;
        }

        @keyframes activeAnimation {
            0% {
                display: block;
                height: 0;
                opacity: 0;
                transform: translateY(-100%);
            }
            50% {
                height: 0;
                opacity: 0;
                transform: translateY(0);
            }
            100% {
                height:calc(54.30px * 7);
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes nonActiveAnimation {
            0% {
                height:calc(54.30px * 7);
                opacity: 1;
                transform: translateY(0);
            }
            50% {
                height: 0;
                opacity: 0;
                transform: translateY(0);
            }
            100% {
                display: none;
                height: 0;
                opacity: 0;
                transform: translateY(-100%);
            }
        }
    }
</style>
