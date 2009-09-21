all: $(subst .abc,.ps,$(wildcard *.abc))

%.ps: %.abc
	abcm2ps -O = -F common.fmt $*.abc

%.pdf: %.ps
	ps2pdf $*.ps

clean:
	-rm *.ps *.pdf
