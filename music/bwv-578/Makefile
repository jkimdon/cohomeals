all: $(subst .abc,.ps,$(wildcard *.abc)) $(subst .ly,.pdf,$(wildcard *.ly))

%.ps: %.abc common.fmt
	abcm2ps -O = -F common.fmt $*.abc

%.pdf: %.ps
	ps2pdf $*.ps

%.pdf: %.ly
	lilypond $*.ly

%.png: %.ly
	lilypond --png --define-default=resolution=300 $*.ly

%.mp3: %.midi
	timidity -Ow $*.midi
	lame $*.wav $*.mp3

%.pdf: %.lytex
	lilypond-book $*.lytex
	latex $*.tex
	dvips -Ppdf $*.dvi
	ps2pdf $*.ps

%.pdf: %.abc
	abcm2ps -O= -c $*.abc
	ps2pdf $*.ps

%.midi: %.abc
	abc2midi $*.abc -o $*.mid -RS


clean:
	-rm *.ps *.pdf *.midi *.mp3 *.wav *.aux *.dvi *.log *.dep *.tex

