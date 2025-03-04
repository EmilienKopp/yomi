<script lang="ts">
    import type { Snippet } from "svelte";
    import { slide, fade } from "svelte/transition";

    interface Props {
        align?: "left" | "right";
        width?: string;
        contentClasses?: string;
        trigger?: Snippet;
        content?: Snippet;
    }

    let {
        align = "right",
        width = "48",
        contentClasses = "py-1 bg-white",
        trigger,
        content,
    }: Props = $props();

    let open = $state(false);

    const closeOnEscape = (e: KeyboardEvent) => {
        if (open && e.key === "Escape") {
            open = false;
        }
    };

    $effect(() => {
        document.addEventListener("keydown", closeOnEscape);
        return () => {
            document.removeEventListener("keydown", closeOnEscape);
        };
    });

    let widthClass = $derived(
        {
            "48": "w-48",
        }[width],
    );

    let alignmentClasses = $derived(() => {
        if (align === "left") {
            return "ltr:origin-top-left rtl:origin-top-right start-0";
        } else if (align === "right") {
            return "ltr:origin-top-right rtl:origin-top-left end-0";
        } else {
            return "origin-top";
        }
    });
</script>

<div class="relative">
    <div
        tabindex="-1"
        onclick={() => (open = !open)}
        onkeydown={(e) => e.key === "Enter" && (open = !open)}
        role="button"
    >
        {@render trigger?.()}
    </div>

    <!-- Full Screen Dropdown Overlay -->
    {#if open}
        <div
            role="button"
            tabindex="-1"
            class="fixed inset-0 z-40"
            onclick={() => (open = false)}
            onkeydown={(e) => e.key === "Enter" && (open = false)}
        ></div>
    {/if}

    {#if open}
        <div
            tabindex="-1"
            role="menu"
            transition:fade={{ duration: 200 }}
            class="absolute z-50 mt-2 rounded-md shadow-lg {widthClass} {alignmentClasses}"
            onclick={() => (open = false)}
            onkeydown={(e) => e.key === "Escape" && (open = false)}
        >
            <div
                class="rounded-md ring-1 ring-black ring-opacity-5 {contentClasses}"
            >
                {@render content?.()}
            </div>
        </div>
    {/if}
</div>
