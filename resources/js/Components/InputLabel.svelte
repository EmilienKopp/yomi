<script lang="ts">
  import type { Snippet } from 'svelte';
  import type { HTMLLabelAttributes } from 'svelte/elements';
  
  interface Props extends HTMLLabelAttributes {
    value?: string;
    children?: Snippet;
  }
  
  let { value = '', children, ...rest }: Props = $props();
</script>

<label class="block text-sm font-medium text-gray-700" {...rest}>
    {#if value}
        {value}
    {:else}
        {@render children?.()}
    {/if}
</label>
