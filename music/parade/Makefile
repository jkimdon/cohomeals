all: parade-music.pdf \
	parade-music-bflat.pdf \
	youre_a_grand_old_flag.midi \
	yankee_doodle.midi \
	when_johnny_comes_marching_home.midi

%.ps: %.abc
	abcm2ps -O = $*.abc

parade-music-bflat.abc: parade-music.abc
	abc2abc parade-music.abc -t 2  > parade-music-bflat.abc

youre_a_grand_old_flag.midi: parade-music.abc
	abc2midi parade-music.abc 1 -Q 120 -o youre_a_grand_old_flag.midi

yankee_doodle.midi: parade-music.abc
	abc2midi parade-music.abc 2 -Q 120 -o yankee_doodle.midi

when_johnny_comes_marching_home.midi: parade-music.abc
	abc2midi parade-music.abc 3 -Q 180 -o when_johnny_comes_marching_home.midi
	
parade-music.midi: parade-music.abc
	abc2midi parade-music.abc -o parade-music.midi

%.pdf: %.ps
	ps2pdf $*.ps

%.mp3: %.midi
	timidity -Ow $*.midi
	lame $*.wav $*.mp3

clean:
	-rm *.ps *.pdf *.midi *.mp3 *.wav parade-music-bflat.abc

