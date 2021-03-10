 <xsl:stylesheet version="1.0" 
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="@*|node()">
        <xsl:copy>
            <xsl:apply-templates select="@*|node()"/>
        </xsl:copy>
</xsl:template>
 
<xsl:template match="/"> 
 
  <h4 class="bg-success">Div cu lista tarilor sortate dupa regiune si nume. Select cu regiunile. </h4>
  <div class="col-md-12">
    <div class="col-md-12 ">
      <div class="col-md-2">
        <select id="regiuni" onChange="cauta()">
          <option>
              <xsl:attribute name="value">0</xsl:attribute>
              Selectati regiunea
          </option>
          <xsl:for-each select="countries/country">             
            <xsl:if test="not((@zone = preceding::country/@zone) or (@type = ancestor::country/@zone))">
              <option>
                <xsl:attribute name="value"><xsl:value-of select="@zone"/></xsl:attribute>
                <xsl:value-of select="@zone"/>
              </option>
            </xsl:if>       
          </xsl:for-each> 
        </select>
      </div>
      <div class="col-md-2 "><p class="font-weight-bold">Țară</p></div>
      <div class="col-md-2">Limbă</div>
      <div class="col-md-2">Monedă</div>
      <div class="col-md-2">Latitudine</div>
      <div class="col-md-2">Longitudine</div>
      
    </div>
    <xsl:for-each select="countries/country">
      
      <xsl:sort select="@zone"/>
      <xsl:sort select="name"/>
      <div>
        <xsl:attribute name="class">col-md-12 cls_country <xsl:value-of select="@zone"/></xsl:attribute>
        <xsl:attribute name="data-regiune"><xsl:value-of select="@zone"/></xsl:attribute>
        <div class="col-md-2"><xsl:value-of select="@zone"/></div>
        <div class="col-md-2">
          <xsl:value-of select="name"/> 
          <xsl:for-each select="name">
                (<xsl:value-of select="@native"/>)
                
          </xsl:for-each>
        </div>
        <div class="col-md-2">
          <xsl:value-of select="language"/> 
          <xsl:for-each select="language">
                (<xsl:value-of select="@native"/>)
                
          </xsl:for-each> 
        </div>
        <div class="col-md-2">
           <xsl:value-of select="currency"/> 
           <xsl:for-each select="currency">
               (<xsl:value-of select="@code"/>)
              
            </xsl:for-each> 
         </div>
        <div class="col-md-2"><xsl:value-of select="logitudine"/></div>
        <div class="col-md-2"><xsl:value-of select="latitudine"/></div>
      </div>
      
    </xsl:for-each>
  </div>
   
</xsl:template>
 
</xsl:stylesheet>
