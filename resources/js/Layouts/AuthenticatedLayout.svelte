<script lang="ts">
    import type { Snippet } from "svelte";
    import ApplicationLogo from "$components/ApplicationLogo.svelte";
    import Dropdown from "$components/Dropdown.svelte";
    import DropdownLink from "$components/DropdownLink.svelte";
    import NavLink from "$components/NavLink.svelte";
    import ResponsiveNavLink from "$components/ResponsiveNavLink.svelte";
    import { Link, page } from "@inertiajs/svelte";

    interface Props {
        children?: Snippet;
        header?: Snippet;
    }

    let { children, header }: Props = $props();

    let showingNavigationDropdown = $state(false);
</script>

<div>
    <div class="min-h-screen bg-gradient-to-br from-primary-50 via-white to-secondary-50">
        <nav class="border-b border-primary-100 bg-white/90 backdrop-blur-sm">
            <!-- Primary Navigation Menu -->
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex shrink-0 items-center">
                            <Link href={route("dashboard")}>
                                <ApplicationLogo
                                    class="block h-9 w-auto fill-current text-primary-600"
                                />
                            </Link>
                        </div>

                        <!-- Navigation Links -->
                        <div
                            class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                        >
                            <NavLink
                                href={route("dashboard")}
                                active={route().current("dashboard")}
                            >
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                </div>
                            </NavLink>
                            <NavLink
                                href={route("dashboard")}
                                active={false}
                            >
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    Library
                                </div>
                            </NavLink>
                            <NavLink
                                href={route("dashboard")}
                                active={false}
                            >
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Community
                                </div>
                            </NavLink>
                        </div>
                    </div>

                    <div class="hidden sm:ms-6 sm:flex sm:items-center">
                        <!-- Settings Dropdown -->
                        <div class="relative ms-3">
                            <Dropdown align="right" width="48">
                                {#snippet trigger()}
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center rounded-full border border-transparent bg-primary-50 px-4 py-2 text-sm font-medium leading-4 text-primary-700 transition duration-150 ease-in-out hover:bg-primary-100 focus:outline-none"
                                        >
                                            {$page?.props?.auth?.user?.name}

                                            <svg
                                                class="-me-0.5 ms-2 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                {/snippet}

                                {#snippet content()}
                                    <div>
                                        <DropdownLink
                                            href={route("profile.edit")}
                                        >
                                            Profile
                                        </DropdownLink>
                                        <DropdownLink
                                            href={route("logout")}
                                            method="post"
                                        >
                                            Log Out
                                        </DropdownLink>
                                    </div>
                                {/snippet}
                            </Dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button
                            aria-label="Main menu"
                            onclick={() =>
                                (showingNavigationDropdown =
                                    !showingNavigationDropdown)}
                            class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                        >
                            <svg
                                class="h-6 w-6"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    class={showingNavigationDropdown
                                        ? "hidden"
                                        : "inline-flex"}
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    class={showingNavigationDropdown
                                        ? "inline-flex"
                                        : "hidden"}
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div
                class={showingNavigationDropdown
                    ? "block sm:hidden"
                    : "hidden sm:hidden"}
            >
                <div class="space-y-1 pb-3 pt-2">
                    <ResponsiveNavLink
                        href={route("dashboard")}
                        active={route().current("dashboard")}
                    >
                        Dashboard
                    </ResponsiveNavLink>
                </div>

                <!-- Responsive Settings Options -->
                <div class="border-t border-gray-200 pb-1 pt-4">
                    <div class="px-4">
                        <div class="text-base font-medium text-gray-800">
                            {$page?.props?.auth?.user?.name}
                        </div>
                        <div class="text-sm font-medium text-gray-500">
                            {$page?.props?.auth?.user?.email}
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink href={route("profile.edit")}>
                            Profile
                        </ResponsiveNavLink>
                        <ResponsiveNavLink href={route("logout")}>
                            Log Out
                        </ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        {#if header}
            <header class="bg-white/80 shadow-sm backdrop-blur-sm">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    {@render header()}
                </div>
            </header>
        {/if}

        <!-- Page Content -->
        <main>
            <div class="relative">
                <!-- Decorative elements -->
                <div class="absolute -top-10 left-1/4 h-32 w-32 rounded-full bg-accent-200 opacity-20 blur-3xl"></div>
                <div class="absolute right-1/3 top-1/4 h-48 w-48 rounded-full bg-secondary-200 opacity-20 blur-3xl"></div>
                <div class="absolute bottom-1/4 right-1/4 h-40 w-40 rounded-full bg-primary-200 opacity-20 blur-3xl"></div>
                
                <!-- Actual content -->
                <div class="relative z-10">
                    {@render children?.()}
                </div>
            </div>
        </main>
    </div>
</div>
