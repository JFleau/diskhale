""Linux-Mandrake configuration.
"Chmouel Boudjnah <chmouel@mandrakesoft.com>

"Syntax highlighting only for enhanced-vi
"syntax on

"I know it's horrible for a vi master but useful for newbies.
imap <C-a> <Esc>I
imap <C-e> <ESC>A
map <C-Tab> <C-W>w
imap <C-Tab> <C-O><C-W>w
cmap <C-Tab> <C-C><C-Tab>

"Some macros to manage the buffer of vim
map <F5> :bp<C-M>
map <F6> :bn<C-M>
map <F7> :bd<C-M>

"Default tab for 4
set ts=4
set sw=4

"Default backspace like normal
set bs=2

set ai			" always set autoindenting on

"Terminal for 80 char ? so vim can play till 79 char.
set textwidth=79

"Some option desactivate by default (remove the no).
set nobackup
set nohlsearch
set noincsearch

let bash_is_sh=1

"Select a nice font"
set gfn=-b&h-lucidatypewriter-medium-r-normal-*-*-120-*-*-m-*-iso8859-1

"Choose dark background"
set bg=light

"Display a status-bar.
set laststatus=2

"Show the position of the cursor.
set ruler

"Show matching parenthese.
set showmatch

"To display color on a vanilla xterm (Use Rxvt luke).
if &term=="xterm"
	set t_Co=8
"	set t_AB=<ESC>[%?%p1%{8}%<%t%p1%{40}%+%e%p1%{92}%+%;%dm
"	set t_AF=<ESC>[%?%p1%{8}%<%t%p1%{30}%+%e%p1%{82}%+%;%dm
endif

"" Gzip and Bzip2 files support
" Take from the Debian package and the exemple on $VIM/vim_exemples
if has("autocmd")

" Set some sensible defaults for editing C-files
augroup cprog
  " Remove all cprog autocommands
  au!

  " When starting to edit a file:
  "   For *.c and *.h files set formatting of comments and set C-indenting on.
  "   For other files switch it off.
  "   Don't change the order, it's important that the line with * comes first.
  autocmd FileType *       set formatoptions=tcql nocindent comments&
  autocmd FileType c,cpp set formatoptions=croql cindent comments=sr:/*,mb:*,el:*/,://
augroup END

" Also, support editing of gzip-compressed files. DO NOT REMOVE THIS!
" This is also used when loading the compressed helpfiles.
augroup gzip
  " Remove all gzip autocommands
  au!

  " Enable editing of gzipped files
  "	  read:	set binary mode before reading the file
  "		uncompress text in buffer after reading
  "	 write:	compress file after writing
  "	append:	uncompress file, append, compress file
  autocmd BufReadPre,FileReadPre	*.gz set bin
  autocmd BufReadPre,FileReadPre	*.gz let ch_save = &ch|set ch=2
  autocmd BufReadPost,FileReadPost	*.gz '[,']!gunzip
  autocmd BufReadPost,FileReadPost	*.gz set nobin
  autocmd BufReadPost,FileReadPost	*.gz let &ch = ch_save|unlet ch_save
  autocmd BufReadPost,FileReadPost	*.gz execute ":doautocmd BufReadPost " . %:r

  autocmd BufWritePost,FileWritePost	*.gz !mv <afile> <afile>:r
  autocmd BufWritePost,FileWritePost	*.gz !gzip <afile>:r

  autocmd FileAppendPre			*.gz !gunzip <afile>
  autocmd FileAppendPre			*.gz !mv <afile>:r <afile>
  autocmd FileAppendPost		*.gz !mv <afile> <afile>:r
  autocmd FileAppendPost		*.gz !gzip <afile>:r
augroup END

augroup bzip2
  " Remove all bzip2 autocommands
  au!

  " Enable editing of bzipped files
  "       read: set binary mode before reading the file
  "             uncompress text in buffer after reading
  "      write: compress file after writing
  "     append: uncompress file, append, compress file
  autocmd BufReadPre,FileReadPre        *.bz2 set bin
  autocmd BufReadPre,FileReadPre        *.bz2 let ch_save = &ch|set ch=2
  autocmd BufReadPost,FileReadPost      *.bz2 set cmdheight=2|'[,']!bunzip2
  autocmd BufReadPost,FileReadPost      *.bz2 set cmdheight=1 nobin|execute ":doautocmd BufReadPost " . %:r
  autocmd BufReadPost,FileReadPost      *.bz2 let &ch = ch_save|unlet ch_save

  autocmd BufWritePost,FileWritePost    *.bz2 !mv <afile> <afile>:r
  autocmd BufWritePost,FileWritePost    *.bz2 !bzip2 <afile>:r

  autocmd FileAppendPre                 *.bz2 !bunzip2 <afile>
  autocmd FileAppendPre                 *.bz2 !mv <afile>:r <afile>
  autocmd FileAppendPost                *.bz2 !mv <afile> <afile>:r
  autocmd FileAppendPost                *.bz2 !bzip2 -9 --repetitive-best <afile>:r
augroup END

endif " has ("autocmd")

if &t_Co > 2 || has("gui_running")
  syntax on
  set hlsearch
endif

