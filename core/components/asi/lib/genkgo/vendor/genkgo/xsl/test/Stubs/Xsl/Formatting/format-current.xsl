<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:param name="picture" />

    <xsl:output omit-xml-declaration="yes" />

    <xsl:template match="/">
        <xsl:value-of select="format-date(current-date(), $picture)" />
    </xsl:template>

</xsl:stylesheet>