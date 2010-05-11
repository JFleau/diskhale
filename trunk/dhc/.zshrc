## Linux-Mandrake configuration
# Chmouel Boudjnah <chmouel@mandrakesoft.com> 

# Insert
bindkey "^[[2~" yank

# Suppr
bindkey "^[[3~" delete-char

# Begin
bindkey "^[[1~" beginning-of-line

# End
bindkey "^[[4~" end-of-line

# Up
bindkey "^[[5~" up-line-or-history

# Down
bindkey "^[[6~" down-line-or-history

# Completion for zsh, if you have a slow machine comment these lines !!!
_compdir=/usr/share/zsh/functions/Core
[[ -z $fpath[(r)$_compdir] ]] && fpath=($fpath $_compdir)
autoload -U compinit
compinit

# Exemple how do you can make a macro with zsh :
# bindkey -s ^xs '\C-e"\C-asu -c "'
