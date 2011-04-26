all: score.pdf melody-bflat.pdf bass.pdf

%.ps: %.abc
	abcm2ps +Q -O = $*.abc

%.abc: %.notes
	(cat header.abc $*.notes) > $*.abc

%-bflat.abc: %.abc
	abc2abc $*.abc -t 2  > $*-bflat.abc

score.abc: header.abc melody.notes bass.notes
	(cat header.abc; echo "V: melody"; cat melody.notes; echo "V: bass"; cat  bass.notes) > score.abc

parade-music.midi: parade-music.abc
	abc2midi parade-music.abc -o parade-music.midi

%.pdf: %.ps
	ps2pdf $*.ps

%.mp3: %.midi
	timidity -Ow $*.midi
	lame $*.wav $*.mp3

clean:
	-rm *.ps *.pdf *.midi *.mp3 *.wav parade-music-bflat.abc

