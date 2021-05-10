:- initialization main.
:- discontiguous win/4.
:- discontiguous hero/1.

?- consult('rule.txt').

/* Scoring Engine */
gmeans_multiply(_, [], 1).
gmeans_multiply(Hero, [Enemy|T], Score) :-
    gmeans_multiply(Hero, T, Rest),
    win(Hero, Enemy, _, Percentage),
    Score is Rest * Percentage.
gmeans(Hero, Enemies, Score) :-
    gmeans_multiply(Hero, Enemies, Total),
    length(Enemies, Length),
    pow(Total, 1/Length, Score).

/* Convert List Atom to List String */
atom_string_list([], []).
atom_string_list([H|T], [DH|Rest]) :-
    atom_string_list(T, Rest),
    atom_string(H, DH).

/* Compute Engine */
compute(Enemies, Result) :-
    findall(X, hero(X), AllHeroes),
    remove_list(AllHeroes, Enemies, Heroes),
    scoring(Heroes, Enemies, Result).
scoring([], _, []).
scoring([Hero|T], Enemies, [(Hero,Score)|Rest]) :-
    scoring(T, Enemies, Rest),
    gmeans(Hero, Enemies, Score).

/* Filter List */
remove_list([], _, []).
remove_list([X|Tail], L2, Result):- member(X, L2), !, remove_list(Tail, L2, Result). 
remove_list([X|Tail], L2, [X|Result]):- remove_list(Tail, L2, Result).

/* Sorting */
compare_tuples_descending('<', (_, X), (_, Y)) :- X > Y, !.
compare_tuples_descending('>', _, _).
sort_tuples_descending(Unsorted, Sorted) :- predsort(compare_tuples_descending, Unsorted, Sorted).

/* Take */
take(0, _, []) :- !.
take(N, [H|TA], [H|TB]) :-
    N > 0,
    N2 is N - 1,
    take(N2, TA, TB).

/* Format Print Score */
print_score([]).
print_score([(Hero, Score)|Rest]) :-
    write(Hero),
    write(";"),
    write(Score),
    nl,
    print_score(Rest).

/* Main */
main :-
    current_prolog_flag(argv, Argv),
    atom_string_list(Argv, Enemies),
    compute(Enemies, Result),
    sort_tuples_descending(Result, SortedResult),
    take(5, SortedResult, FilteredSortedResult),
    print_score(FilteredSortedResult),
    halt(0).