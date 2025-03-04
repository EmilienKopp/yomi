<script lang="ts">
  import type { Snippet } from 'svelte';
    import { HTMLButtonAttributes } from 'svelte/elements';
  
  interface Props extends HTMLButtonAttributes {
    children?: Snippet;
  }
  
  let { children }: Props = $props();
</script>

<button
    class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900"
>
    {@render children?.()}
</button>
