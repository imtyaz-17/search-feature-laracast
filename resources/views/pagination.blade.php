<div class="bg-white px-4 py-3 flex items-center justify-between sm:px-6">
    <div class="flex-1 flex justify-between sm:hidden">
        <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
            Previous
        </a>
        <a href="{{ $paginator->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
            Next
        </a>
    </div>
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <p class="text-sm leading-5 text-gray-700">
            @if ($paginator->total() === 0)
                No results found
            @elseif ($paginator->total() === 1)
                Showing
                <span class="font-medium">1</span>
                result
            @elseif ($paginator->hasPages())
                Showing
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                to
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                of
                <span class="font-medium">{{ $paginator->total() }}</span>
                results
            @else
                Showing
                <span class="font-medium">{{ $paginator->total() }}</span>
                results
            @endif
        </p>
        <div class="{{ $paginator->hasPages() ? '' : 'invisible' }}">
      <span class="relative z-0 inline-flex shadow-sm">

        {{-- Previous Page Link --}}
          @if ($paginator->onFirstPage())
              <div class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-400">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
          </div>
          @else
              <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
          </a>
          @endif

          {{-- Pagination Elements --}}
          @foreach ($elements as $element)
              {{-- "Three Dots" Separator --}}
              @if (is_string($element))
                  <span class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700">
              {{ $element }}
            </span>
              @endif

              {{-- Array Of Links --}}
              @if (is_array($element))
                  @foreach ($element as $page => $url)
                      @if ($page == $paginator->currentPage())
                          <div class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 bg-gray-50">
                  {{ $page }}
                </div>
                      @else
                          <a href="{{ $url }}" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                  {{ $page }}
                </a>
                      @endif
                  @endforeach
              @endif
          @endforeach

          {{-- Next Page Link --}}
          @if ($paginator->hasMorePages())
              <a href="{{ $paginator->nextPageUrl() }}" class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
          </a>
          @else
              <div class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-400">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
          </div>
          @endif

      </span>
        </div>
    </div>
</div>
