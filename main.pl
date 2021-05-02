:- initialization main.
:- discontiguous win/4.

?- consult('rule.txt').

gmeans_multiply(_, [], 1).
gmeans_multiply(Hero, [H|T], Result) :-
    atom_string(H, Enemy),
    gmeans_multiply(Hero, T, Rest),
    win(Hero, Enemy, _, Percentage),
    Result is Rest * Percentage.
gmeans(Hero, Enemies, Result) :-
    gmeans_multiply(Hero, Enemies, Total),
    length(Enemies, Length),
    pow(Total, 1/Length, Result).

list_hero(Enemies) :-
    hero(Hero),
    gmeans(Hero, Enemies, Result),
    write(Hero),
    write(";"),
    write(Result),
    nl,
    fail.

main :-
    current_prolog_flag(argv, Argv),
    list_hero(Argv);
    halt(0).