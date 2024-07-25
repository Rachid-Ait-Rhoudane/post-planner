<script setup>

import Dropdown from './Dropdown.vue';
import DropdownLink from './DropdownLink.vue';

</script>

<template>

    <div class="p-2 flex items-center gap-3">
        <div class="relative w-fil">
            <img class="w-16 aspect-square rounded-full" src="https://prairievillagedentist.com/wp-content/uploads/2019/02/iu-1-1200x800.jpeg" alt="facebook page image" />
            <span class="w-5 h-5 absolute right-0 bottom-0 bg-blue-500 rounded-full flex items-center justify-center">
                <i class="fa-brands fa-facebook-f text-xs text-white"></i>
            </span>
        </div>
        <div class="flex-1 flex justify-between items-center">
            <div>
                <h3 class="font-bold">Page name</h3>
                <span class="block text-sm text-gray-500">Facebook page</span>
            </div>

            <div>
                <Dropdown>
                    <template #trigger>
                        <button type="button">
                            <i class="fa-solid fa-gear text-gray-500"></i>
                        </button>
                    </template>
                    <template #content>
                        <DropdownLink href="#">
                            Refresh Connection
                        </DropdownLink>
                        <DropdownLink href="#">
                            Disconnect Channel
                        </DropdownLink>
                    </template>
                </Dropdown>
            </div>
        </div>
    </div>

</template>
