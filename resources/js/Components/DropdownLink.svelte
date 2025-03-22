<script lang="ts">
  import type { Snippet } from 'svelte';
  import { Link } from '@inertiajs/svelte';
  
  interface Props {
    href: string;
    method?: string;
    children?: Snippet;
  }
  
  let { href, children, method }: Props = $props();
</script>

<Link
    {href} {method}
    class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
>
    {@render children?.()}
</Link>
